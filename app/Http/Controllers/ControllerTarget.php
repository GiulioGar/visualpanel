<?php

namespace App\Http\Controllers;
use App\Models\Target;
use App\Models\Associazioni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ControllerTarget extends Controller
{

//STAMPA TARGET
public function stampaTarget()
{
    $viewTarget=Target::get();
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
            'prj'=>'required',
            'code'=>'required',
            'options'=>'required'
        ];

        $ErrorMessages = [
            'sid.required'=>'Il campo ricerca è obbligatorio',
            'prj.required'=>'Il campo progetto è obbligatorio',
            'code.required'=>'Il campo codice domanda è obbligatorio',
            'options.required'=>'Il campo opzioni domanda è obbligatorio'
        ];

        $this->validate(
            $dati,
            [ 'sid'=>'required|max:50'],
            [ 'prj'=>'required|max:50'],
            [ 'code'=>'required|max:50'],
            [ 'options'=>'required' ]
        );

        $dati=request()->validate($rules, $ErrorMessages);


        $ass= new Associazioni();
        $ass->targetId=$targetInfo->id;
        $ass->sid=$dati["sid"];
        $ass->prj=$dati["prj"];
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



//// download csv ///

public function csvDownload($id){

    $users=$this->creaUserList($id);

    return Excel::download(new UsersExport($users), 'users.csv');

}


public function creaUserList($id)
{
//leggo tabella
$viewTarget=Target::with('regole')->where("id",$id)->get();
$userListGlobal=[]; 
//conto gli utenti

$guest="GUEST";
$idex="IDEX";
foreach ($viewTarget as $target)
{
$userList=[];    
$uidOpt="";

    foreach ($target->regole as $regola)
        {

            // consultazione API Primis
            $response = Http::withHeaders([
                'Authorization' => 'Bearer U3lMWWFBcktGZmM1MjdQRzpTUnV3dzROU1FtM2JGZTJZQndDdlF2TkNERXc4MmdiSzdhelkyQldYZjZSYVZWc3VHY3hLTVk1QjVZakF0YnAz'
            ])->get("https://www.primisoft.com/primis/api/v1/projects/$regola->prj/surveys/$regola->sid/questions/$regola->questionCode/answers");

           $jsonData = $response->json();
           //dd($jsonData["answers"]);

           foreach($jsonData["answers"] as $answers)
           {
            // controllo su singola
            if($answers["selection_type"]=="single")
            {
             if ($answers["selection"]==$regola->optionCode)
                {
                $uidOpt=$answers["user_id"];
                if($uidOpt !=""  && !str_contains($uidOpt, "IDEX"))
                {
                
                array_push($userList,$uidOpt);
                }


                }
            }

            //controllo su multipla
            if($answers["selection_type"]=="multiple")
            {
                if (in_array($regola->optionCode, $answers["selection"]))
                {
                 $uidOpt=$answers["user_id"];
                 if( $uidOpt !=""  && !str_contains($uidOpt, "IDEX"))
                {
            
                array_push($userList,$uidOpt);
                }


                }
            }


           }

           $userList = array_unique($userList);
           $users=[];
           foreach ($userList as $u){
            $users[]["UID"]=$u;
           }

           $userListGlobal[]=$users;

           //$uvar=$this->csvDownload($userList);
           
        //dd($userList);


        }

    }
    return $userListGlobal;
    //dd($viewTarget);

}

    //CONTA USERS
    public function countUsers($id)
    {
    $users=$this->creaUserList($id);
    $nomeTarget=Target::find($id);

    return view("vediTarget", compact("users","nomeTarget"));
    }


}
