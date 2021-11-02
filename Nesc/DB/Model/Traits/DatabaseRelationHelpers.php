<?php
namespace DB\Model\Traits;

trait DatabaseRelationHelpers{
    //gather all the desired object format into one array
    protected function oneToManyJson($relatedModel , $jsonObj){
        $columns = $this->getAllColumns($relatedModel);
        $jsonArr = [];
        $temp = [];
        $jsonArrCounter = 0;
        $person_id = -1;
        
        for($i = 0; $i < sizeof($jsonObj); $i++){
            //gather the same related object to specific primary key
            if($person_id === $jsonObj[$i][$this->table.'_id']){
                for($j = 0; $j < sizeof($columns); $j++){
                    $temp[$columns[$j]] = $jsonObj[$i][$columns[$j]];
                }
                array_push($jsonArr[$jsonArrCounter][$relatedModel] , $temp);
            }else{
                $person_id = $jsonObj[$i][$this->table.'_id'];
                $jsonArr[++$jsonArrCounter] = $this->encapsulateRelatedModel($relatedModel , $jsonObj , $i);
            }
        }
        return $jsonArr;
    }

    //create the desired object format
    private function encapsulateRelatedModel($relatedModel , $jsonObj , $index){
        $jsonArr = [];
        $temp = [];
        $counter = 0;
        $columns = array_merge($this->getAllColumns($this->table) , $this->getAllColumns($relatedModel));


        for($i = 0; $i < sizeof($columns); $i++){
            if(substr($columns[$i] , 0 ,strpos($columns[$i] , '_'))  === $relatedModel){
                // counter is 1 if related Model is null
                if($counter === 1){
                    break;
                }else if($jsonObj[$index][$columns[$i]] === null){
                    $temp = null;
                    $counter++;
                }else {
                    //get related columns
                    $temp[$columns[$i]] = $jsonObj[$index][$columns[$i]];
                }
            }else {
                $jsonArr[$columns[$i]] = $jsonObj[$index][$columns[$i]];
            }
        }


        is_array($temp) === true ? $jsonArr[$relatedModel] = [$temp]: $jsonArr[$relatedModel] = $temp;
        return $jsonArr;
    }

    // jump from the pivot table to the specific related Model and get related records from it
    public function getRelatedRecordsFromId($model , $foreignKey , $pivot , $primaryKey = 'id'){
        $className = strtolower($this->getClass()).'s';
        $temp = $this->queryResult;   //get the query result from find 
        $selectedModelMatching = $this->findByColumn($foreignKey , $temp['0']['id']  , ['*'] , $pivot)
            ->get();
        $relatedModelMatching = [];

        //if the selected model id didn't relate to related model id
        if(empty($selectedModelMatching)){
            $selectedModelMatching = $this->findByColumn($primaryKey , $temp['0']['id']  , ['*'] , $className)
                ->get();

            $selectedModelMatching[0][$model] = null;
            return $selectedModelMatching[0];
        }
        
        //if the pivot table in that form orders_items
        if(!strpos($model , '_')) {
            for ($i = 0; $i < count($selectedModelMatching); $i++) {

                $relatedModelMatching[$i] = $this->findByColumn($primaryKey , $selectedModelMatching[$i][$model.'Id'] , ['*'] , $model)
                    ->get();
                $relatedModelMatching[$i] = $relatedModelMatching[$i][0];

                if($i !== 0){
                    unset($selectedModelMatching[$i]);
                }else{
                    unset($selectedModelMatching[$i][$model.'Id']);
                }

            }
            $selectedModelMatching[0][$model] = $relatedModelMatching;
        }
        return $selectedModelMatching[0];
    }
}