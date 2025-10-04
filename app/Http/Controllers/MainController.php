<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
   public function index() {
        // devolvendo todos os dados de uma tabela
        // $clients = DB::table('clients')->get(); // SELECT * FROM clients
        
        // apresentar num array associativo e em objetos
        // $clients = DB::table('clients')->get()->toArray();

        // apresentar num array de arrays associativos
        // map faz um ciclo foreach pelos produtos e devolvê-los como um array
        $results = DB::table('products')->get()->map(function($item){
            return (array) $item;
        });

        // apresentar os dados a partir dos resultados
        // $products = DB::table('products')->get();
        // foreach ($products as $product) {
        //    echo $product->product_name . "<br>";
        // }

        // obter apenas algumas colunas
        // $products = DB::table('products')->get(['product_name', 'price']);
        
        // pluck - obter de forma simples os dados de uma coluna específica
        // $results =  Db::table('products')->pluck('product_name');

        //devolver apenas a primeira linha de um resultado
        // $results =  Db::table('products')->get()->first();

        //devolver apenas a última linha de um resultado
        // $results =  Db::table('products')->get()->last();

        // SELECT * FROM products WHERE id = 10
        // $results = DB::table('products')->find(10);


        // SELECT com where
        // $products = DB::table('products')->where('id', ">=", 10)->get();

        // $products = Db::table("products")
        //             ->select('product_name', 'price')
        //             ->get();
        // Apresentação muito comum de se ver

        // $products = DB::table('products')
        //             ->select('product_name')->get();

        // SELECT * FROM products WHERE price > 50
        // $products = DB::table('products')
        //             ->where('price', '>', 70)
        //             ->get();

        // SELECT * FROM products WHERE price > 50 AND product_name LIKE "A%"
        // $products = DB::table('products')
        //             ->where('price', '>', 30)
        //             ->where('product_name', 'like', 'A%')
        //             ->get();

        // SELECT * FROM products WHERE price > 50 OR product_name LIKE "A%"
        // $products = DB::table('products')
        //             ->where('price', '>', 80)
        //             ->orWhere('product_name', 'like', 'A%')
        //             ->get();


        //  $products = DB::table('products')
        //             ->where([
        //                 ['price', ">", 30],
        //                 ['product_name', 'like', 'A%']
        //             ])->get();

        $products =  DB::table('products')
                     ->where('price', '>', 90.15)
                     ->orWhere(function(Builder $query) {
                        $query->where('product_name', 'Banana')
                    ->orWhere('product_name', 'Cereja');
                     })->get();
        
        // $this->showRawData($products);
        $this->showDataTable($products);
        // $this->showRawData($results);
        // $this->showRawData($results);
        // $this->showDataTable($clients);


    }

    private function showRawData($data){
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    private function showDataTable($data){
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
