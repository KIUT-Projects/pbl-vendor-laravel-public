<?php 

if(! function_exists('monthlyStats')){
    function monthlyStats($start, $end, $type = 'order', $duration = 'month', $method = 'add') {
        //start, order, week, add
        $days = numbersRange(1, $end);

        $result = array();
        foreach($days as $key => $day){

            $element = Carbon\Carbon::parse($start);

            if($method = 'add'){
                $date = $element->addDay($day);
            }else{
                $date = $element->subDay($day);
            }

            if($type == 'order'){
                $object = Order::whereDate('created_at', $date);
            }elseif($type == 'user'){
                $object = User::whereDate('created_at', $date);
            }else{
                return NULL;
            }

            $result[] = $object->count();
        }

        return implode(", ", $result);
    }

}

if(! function_exists('numbersRange')){
    function numbersRange($start, $end, $method = 'array') {
        $array = [];

        for($i = $start; $i <= $end; $i++){
            $array[] = $i;
        }

        if($method == 'text'){
            $array = implode(", ", $array);
        }

        return $array;
    }
}