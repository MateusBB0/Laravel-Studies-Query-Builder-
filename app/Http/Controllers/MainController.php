<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index() 
    {  
        // Para refrescar as modificações, vá na página web do seu artisan e atualize 
        // INSERT
        // adicionar um novo cliente

        // UM cliente
        // $new_client = [
        //     'client_name' => 'Mateus Barros',
        //     'email' => 'Mateus@gmail.com'

        // ];
        // DB::table("clients")->insert($new_client);

        // DB::table('clients')
        //     ->insert([
        //       'client_name' => 'Mateus 2',
        //         'email' => 'm2@gmail.com'  
        //     ]) ;

        // adicionar dois clientes
        // DB::table('clients')
        // //  Query builder não consegue editar automaticamente o created_at e o deleted_at, mas o Eloquent ORM sim.
        //     ->insert([
        //         [
        //             'client_name' => 'Pessoa3',
        //             'email' => 'pessoa3@gamil.com',
        //             // Carbon é uma classe de uma biblioteca laravel de datas
        //             'created_at' => Carbon::now()
        //         ],
        //         [
        //             'client_name' => 'Pessoa4',
        //             'email' => 'pessoa4@gmail.com',
        //             'created_at' => Carbon::now()
        //         ]
        //     ]);


        // UPDATE

        // DB::table('clients')
        //     ->where("id", 1)
        //     ->update([

        //     'client_name' => 'Laura ALTERADA',
        //     'email' => 'lauraALTERADA@gmail.com', 

        //     ]);

        // DB::table('clients')
        //     ->where('client_name', 'Catarina Melany Cunha')
        //     ->update([
        //         'email' => "newemail@gmail.com"
        //     ]);

        // DELETE
        // 2 formas de delete: Hard delete(remover 'fisicamente' da tabela) e o Soft delete(usar o deleted_at; fará uma maior diferença quando for usado o Eloquent ORM)
        
        // HARD DELETE
        // DB::table('clients')
        //     ->where("id", '507')
        //     ->delete();

        // SOFT DELETE
        DB::table('clients')
            ->where("id", '1')
            ->update([
                'deleted_at' => Carbon::now()
            ]);    


    }

private function showRawData($data)
    {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    private function showDataTable($data)
    {
        echo '<table border="1">';
        // header
        echo '<tr>';
        foreach($data[0] as $key=>$value){
            echo '<th>'. $key . '</th>';
        }
        echo '</tr>';
        foreach($data as $row){
            echo "<tr>";
            foreach($row as $key => $value){
                echo '<th>'. $value . '</th>';
            }
            echo "</tr>";
        }   
        echo '<table/>';
        
    }

}
