<?php

namespace App\Repositories;

use App\Models\Denuncia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class DenunciasRepository {

    public function denunciasPorResponsable(string $search, string $sortBy, bool $sortAsc){

        // Consulta base con las relaciones necesarias
        $denuncia = Denuncia::denunciasByAreaResponable()
            ->with(['contacto', 'circunstancia.municipio'])
            ->select('denuncia.*')
            ->join('denuncia_circunstancia as dc', 'denuncia.id_denuncia', '=', 'dc.id_denuncia')
            ->leftJoin('datos_contacto_denunciante as dcd', 'denuncia.id_denuncia', '=', 'dcd.id_denuncia')
            ->leftJoin('cat_municipios as cm', 'dc.id_municipio', '=', 'cm.id_municipio')

            // Lógica de Búsqueda
            ->when($search, function (Builder $query, $search){
                $query->where(function (Builder $q) use ($search) {
                    $q->where('denuncia.folio_seguimiento', 'like', '%' . $search . '%')
                        ->orWhere('denuncia.motivo_denuncia', 'like', '%' . $search . '%')
                        // Búsqueda en tablas relacionadas (es más complejo, pero Livewire lo permite)
                        ->orWhere('dcd.nombre_completo', 'like', '%' . $search . '%')
                        ->orWhere('dc.dependencia_involucrada', 'like', '%' . $search . '%')
                        ->orWhere('cm.nombre_municipio', 'like', '%' . $search . '%');
                });
            })
            ->orderBy($sortBy, $sortAsc ? 'asc' : 'desc')
            ->paginate(10); 

        return $denuncia;
    }

    public function totalDenunciasArea(){

        return Denuncia::denunciasArea()->count();
    }

    public function getDenunciasArea(){

        return Denuncia::denunciasArea()->orderBy('folio_seguimiento', 'desc')->get();
    }

    public function totalDenunciasTurnadasResponsable(){

        return Denuncia::denunciasEstatus(3)->count();

    }

    public function getDenunciasEnTramite(){

        return Denuncia::denunciasEstatus(3)->orderBy('folio_seguimiento', 'desc')->get();

    }

    public function totalDenunciasTerminadasResponsable(){

        return Denuncia::denunciasEstatus(4)->count();
    }

    public function getDenunciasTerminadas(){

        return Denuncia::denunciasEstatus(4)->orderBy('folio_seguimiento', 'desc')->get();

    }

    public function totalDenunciaAreaResponsable(){

        return Denuncia::denunciasArea()->count();
    }

    public function totalDenunciasAnonimas(){

        return Denuncia::denunciasAnonimas(1)->count();
    }

    public function getDenunciasAnonimas(){

        return Denuncia::denunciasAnonimas(1)->orderBy('folio_seguimiento', 'desc')->get();

    }

    public function totalDenunciasNoAnonimas(){

        return Denuncia::denunciasAnonimas(0)->count();
    }

    public function getDenunciasNoAnonimas(){

        return Denuncia::denunciasAnonimas(0)->orderBy('folio_seguimiento', 'desc')->get();

    }

    public function totalDenuncias(){
        return Denuncia::count();
    }

    public function getDenuncias(){
        return Denuncia::orderBy('folio_seguimiento', 'desc')->get();
    }

    public function cambiarDenunciaATramite(int $id_denuncia, int $status){

        try {
            DB::beginTransaction();

            // Buscar el registro
            $denuncia = Denuncia::findOrFail($id_denuncia);

            // Cambiar el estatus (ajusta el nombre del campo según tu tabla)
            $denuncia->id_estado = $status;
            $denuncia->save();

            DB::commit();
            return $denuncia;
        } catch (\Exception $e){
            DB::rollBack();
            \Log::error("Error al cambiar el estatus de la denuncia: " . $e->getMessage());
        }

    }



}

?>