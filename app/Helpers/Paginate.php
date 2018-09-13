<?php
namespace App\Helpers;
/**
* Custome paginate helper class
*/
class Paginate{

	protected $model;

	function __construct($model, $fields=[]){

		if(is_string($model)) $this->model=new $model;
		elseif(is_object($model)) $this->model=$model;
		
		$this->fields=$fields;

		if(request('wholeWord')=='on'){
    		$this->wholeWordActiveFlag='active';
    		$wildCard='';
    	}else{
    		$this->wholeWordActiveFlag=NULL;
    		$wildCard='%';
    	}

    	if(request('order')=='DESC'){
    		$this->ascActiveFlag=NULL;
    		$this->descActiveFlag='active';
    	}else{
    		$this->ascActiveFlag='active';
    		$this->descActiveFlag=NULL;
    	}


            
            $this->table=$this->model->where(
                \DB::raw('CAST('.request()->input('activeField','id').' as TEXT)'),
                'like',
                $wildCard.request('search').$wildCard
            )->orderBy(request()->input('activeField','id'),
                request()->input('order', 'ASC')
            )->paginate(
                request()->input('limit', 10)
            );


        $this->totalPage=$this->table->lastPage();
	}

}