<?php

namespace App\Http\Controllers;
use App\Models\Target;
use Illuminate\Http\Request;

class ControllerTarget extends Controller
{
    public function stampaTarget()
    {

     $viewTarget=Target::get();
            //dd($ciclisti);
            return view("gestioneTarget", compact('viewTarget'));

    }

    public function store(Request $dati){

        $rules = [
            'nome'=>'required'
        ];

        $ErrorMessages = [
            'nome.required'=>'Il campo nome è obbligatorio'
        ];

        $this->validate(
            $dati,
            [ 'nome'=>'required|max:50|unique:target_list,nome' ],
            [ 'nome.unique' => 'Il target è stato già creato' ]
        );

        $dati=request()->validate($rules, $ErrorMessages);


        $trg= new Target();
        $trg->nome=$dati["nome"];
        $res=$trg->save();
        $messaggio=$res? "Target inserito correttamente!": "Errore:Target non inserito!";

        session()->flash('message',$messaggio);

       return redirect()->back();
    }

}
