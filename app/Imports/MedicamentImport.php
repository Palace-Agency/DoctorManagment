<?php

namespace App\Imports;

use App\Models\Medicament;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class MedicamentImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $medicament = Medicament::where('code',$row['code'])->first();
            if($medicament){
                $medicament->update([
                    'code'=> $row['code'],
                    'nom'=> $row['nom'],
                    'dci1'=> $row['dci1'],
                    'dosage1'=> $row['dosage1'],
                    'unite_dosage1'=> $row['unite_dosage1'],
                    'forme'=> $row['forme'],
                    'presentation'=> $row['presentation'],
                    'ppv'=> $row['ppv'],
                    'ph'=> $row['ph'],
                    'prix_br'=> $row['prix_br'],
                    'princeps_generique'=> $row['princeps_generique'],
                    'taux_remboursement'=> $row['taux_remboursement'],
                ]);

            }else{
                Medicament::create([
                    'code'=> $row['code'],
                    'nom'=> $row['nom'],
                    'dci1'=> $row['dci1'],
                    'dosage1'=> $row['dosage1'],
                    'unite_dosage1'=> $row['unite_dosage1'],
                    'forme'=> $row['forme'],
                    'presentation'=> $row['presentation'],
                    'ppv'=> $row['ppv'],
                    'ph'=> $row['ph'],
                    'prix_br'=> $row['prix_br'],
                    'princeps_generique'=> $row['princeps_generique'],
                    'taux_remboursement'=> $row['taux_remboursement'],
                ]);

            }
        }
        return redirect()->route('medicament.index')->with('success','all the medicamen has been imported successfully');
    }
}
