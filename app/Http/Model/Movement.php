<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Movement extends Model {

    protected $primaryKey = 'movementId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $table    = 'movement';

    public static function getMovements(){
        $movements = Movement::all();

        return $movements;
    }

    public static function getMovement($movementId){
        $movement = Movement::where('movementId','=',$movementId)
            -> select('*')
            -> first();

        return $movement->toArray();
    }

    public static function createMovement($movementBEntity){
        DB::table('movement')->insert(
            array(
                'quantity' => $movementBEntity->getQuantity(),
                'type' => $movementBEntity->getType(),
                'description'=> $movementBEntity->getDescription(),
                'concept'=> $movementBEntity->getConcept(),
                'sender'=> $movementBEntity->getSender(),
                'comprobanteNumber'=> $movementBEntity->getComprobanteNumber(),
                'createdDate'=> $movementBEntity->getAuditoryInformation()->getCreatedDate(),
                'createdBy'=>$movementBEntity->getAuditoryInformation()->getCreatedBy(),
                'paymentId' => $movementBEntity->getPaymentId()
            )
        );
    }

    public static function updateMovement($movementBEntity){
        DB::table('movement')
            ->where('movementId',$movementBEntity->getMovementId())
            ->update(
                array(
                    'quantity' => $movementBEntity->getQuantity(),
                    'type' => $movementBEntity->getType(),
                    'description'=> $movementBEntity->getDescription(),
                    'concept'=> $movementBEntity->getConcept(),
                    'sender'=> $movementBEntity->getSender(),
                    'comprobanteNumber'=> $movementBEntity->getComprobanteNumber(),
                    'modifiedDate'=>$movementBEntity->getAuditoryInformation()->getModifiedDate(),
                    'modifiedBy'=>$movementBEntity->getAuditoryInformation()->getModifiedBy(),
                    'paymentId' => $movementBEntity->getPaymentId()
                )
            );
    }

    public static function updateMovementQuantity($movementBEntity){
        DB::table('movement')
            ->where('paymentId',$movementBEntity->getPaymentId())
            ->update(
                array(
                    'quantity' => $movementBEntity->getQuantity(),
                    'modifiedDate'=>$movementBEntity->getAuditoryInformation()->getModifiedDate(),
                    'modifiedBy' => $movementBEntity -> getAuditoryInformation()->getModifiedBy()
                )
            );
    }

    public static function deleteMovement($movementId){
        DB::table('movement')
            ->where('movementId', $movementId)
            ->delete();
    }

    public static function deleteMovementByPaymentId($paymentId){
        DB::table('movement')
            ->where('paymentId', $paymentId)
            ->delete();
    }


    public static function filterMovement($startDate,$endDate,$type,$groupBy){

        //SQL QUERY : select type, sum(quantity) , MONTH(createdDate) from movement group by type,MONTH(createdDate)

        $query = Movement::query();

        // [1] SELECT type,SUM(quantity),date

            switch($groupBy) {
                case 0 : $stringGroupBy = 'DAY(createdDate)';  break;
                case 1 : $stringGroupBy = 'MONTH(createdDate)';  break;
                case 2 : $stringGroupBy = 'YEAR(createdDate)';  break;
            }

            $query = $query -> select(
                'type',
                DB::raw('SUM(quantity) as quantity'),
                DB::raw($stringGroupBy . ' as date')
            );
            

        // [2] WHERE type = $type
        // (If type is selected)

            if($type != ''){
                if ($type <= 2) {   // [1,2], other cases  this 'where' will not be applied
                    $query = $query -> where('type','=',$type);
                }
            }

        // [3] WHERE createdDate BETWEEN ...

            $query = $query -> whereBetween(DB::raw('DATE(createdDate)'),[$startDate,$endDate]);

        // [4] GROUP BY type, [month][year][day](createdDate)


            $query = $query -> groupBy('type');
            $query = $query -> groupBy(DB::raw( $stringGroupBy ));

        // [5] ORDER BY date ASC

            $query = $query -> orderBy('date','ASC');

        $movementsFiltered = $query -> get();

        return $movementsFiltered;
    }

    public static function filterMovementByDate($startDate,$endDate){

        //SQL QUERY : select * from movement where createdDate BETWEEN..

        $query = Movement::query();

        // [1] SELECT *

            $query = $query -> select(
                '*'
            );
            

        // [2] WHERE createdDate BETWEEN ...

            $query = $query -> whereBetween(DB::raw('DATE(createdDate)'),[$startDate,$endDate]);

        // [3] ORDER BY date ASC

            $query = $query -> orderBy('createdDate','ASC');

        $movementsFiltered = $query -> get();

        return $movementsFiltered;
    }

    public static function getReportOfThisMonth ( ) {
        // SQL QUERY : select sum(quantity), type from movement where year(createdDate)=thisYear AND month(createdDate)=$month group by type;

        $query = Movement::query();

        // [1] SELECT sum(quantity), type

            $query = $query -> select(
                'type',
                DB::raw('SUM(quantity) as quantity')
            );

        // [2] WHERE createdDate BETWEEN ...

            $query = $query -> where(DB::raw('YEAR(createdDate)'),'=',date('Y'));

        // [3] WHERE MONTH(createdDate) = $month

            $query = $query -> where(DB::raw('MONTH(createdDate)'),'=',date('m'));

        // [4] GROUP BY type

            $query = $query -> groupBy('type');

        $reportOfMonth = $query -> get();

        return $reportOfMonth;
    }
    public static function getTotalRevenue(){
        $total =DB::table('movement')-> where("type","1")->sum('quantity');
        return $total;
    }
    public static function getTotalExpenses(){
        $total =DB::table('movement')-> where("type","2")->sum('quantity');
        return $total;
    }
}