<?php

namespace App\Http\Controllers;
use App\Models\Target;
use App\Models\Associazioni;
use Illuminate\Http\Request;

class ControllerTarget extends Controller
{
    //STAMPA TARGET
    public function stampaTarget()
    {

     $viewTarget=Target::get();
            //dd($ciclisti);
            return view("gestioneTarget", compact('viewTarget'));

    }

    //STAMPA ASSOCIAZIONI
    public function stampaAssociazioni(Target $targetInfo)
    {

    $nomeTarget=$targetInfo->nome;
    $idTarget=$targetInfo->id;
    //dd($nomeTarget);

   $viewAss=Associazioni::orderBy('id','ASC')->where('targetId', $idTarget)->get();

   return view("associazioniTarget", compact('viewAss','nomeTarget','idTarget'));

    }

    //crea nuove target
    public function store(Request $dati)
    {

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

    //modifica nome target
    public function update(Target $targ)
    {
        $rules = [
            'nome'=>'required'
        ];

        $ErrorMessages = [
            'nome.required'=>'Il campo nome è obbligatorio'
            
        ];

        $dati=request()->validate($rules, $ErrorMessages);
        $targ->nome=$dati["nome"];
        $res=$targ->save();
        $messaggio=$res? "Nome modificato correttamente": "Errore";

        session()->flash('message',$messaggio);
        return redirect()->back();

    }

    //crea nuove associazioni
    public function storeA(Request $dati, Target $targetInfo)
    {

        $rules = [
            'sid'=>'required',
            'code'=>'required',
            'options'=>'required'
        ];

        $ErrorMessages = [
            'sid.required'=>'Il campo ricerca è obbligatorio',
            'code.required'=>'Il campo codice domanda è obbligatorio',
            'options.required'=>'Il campo opzioni domanda è obbligatorio'
        ];

        $this->validate(
            $dati,
            [ 'sid'=>'required|max:50'],
            [ 'code'=>'required|max:50'],
            [ 'options'=>'required' ]
        );

        $dati=request()->validate($rules, $ErrorMessages);


        $ass= new Associazioni();
        $ass->targetId=$targetInfo->id;
        $ass->sid=$dati["sid"];
        $ass->questionCode=$dati["code"];
        $ass->optionCode=$dati["options"];
        $res=$ass->save();
        $messaggio=$res? "Associazione inserita correttamente!": "Errore:Assoicazione non inserita!";

        session()->flash('message',$messaggio);

       return redirect()->back();
    }

    public function destroy(Target $evento, Associazioni $evento2){
        $evento->delete();
        $evento2->delete();
        return redirect()->back();
    }


    

}
