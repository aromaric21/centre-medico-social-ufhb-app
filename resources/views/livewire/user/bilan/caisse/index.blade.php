<div>

    <div class="page-header">
        <input type="hidden" name="service" id="service" value="Médecine générale">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10 mt-4">Bilan</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/testcentreMedicoSociaux/"><i
                                    class="feather icon-home"></i></a></li>
                        <li class="breadcrumb-item"><a href="#!">Bilan des consultations</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="card container"><br>

            <div class="card-header text-primary row">
                <div class="text-primary col-3 col-lg-3 col-md-12 col-sm-12">
                    <h5 class="text-primary">Bilan activités</h5>
                </div>
                <div class="d-flex justify-content-between col-9 col-lg-9 col-md-12 col-sm-12">
                    <form class="form-inline">
                        &nbsp;
                        <div class="form-group fill">
                            <label class="text-primary" for="mois">Peride du:</label>
                            <input type="date" class="form-control mr-1"   wire:model.live.debounce.5ms='dateDebut'>
                        </div>
                        &nbsp;
                        <div class="form-group ml-2 fill">
                            <label class="text-primary" for="mois">au:</label>
                            <input type="date" class="form-control mr-1"   wire:model.live.debounce.5ms='dateFin'>
                        </div>
                    </form>
                    <div >
                        <button class="btn btn-sm btn-outline-primary ml-3" wire:click="generatePDF">Telecharger le bilan </button>
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="mt-4">
                    <div class="text-center">
                        <h5 class="text-primary">
                            <label id="periodeBilan"><strong>{{$periode}}</strong></label>
                        </h5>
                    </div>
                </div>
                <div class="card-body">

                    
                            <div class="d-flex justify-content-star">
                                <h5 class="ml-5"><span style="font-size:larger">Pharmacie</span> .............................................. <code style="font-size:larger">{{$pharmacie}}</code></h5>
                            </div>
                            <div class="d-flex justify-content-star">
                                <h5 class="ml-5"><span style="font-size:larger">Infirmerie</span> .............................................. <code style="font-size:larger">{{$infirmerie}}</code></h5>
                            </div>
                            <div class="d-flex justify-content-star">
                                <h5 class="ml-5"><span style="font-size:larger">Cabinet dentaire</span> .................................. <code style="font-size:larger">{{$cabinetDentaire}}</code></h5>
                            </div>
                            <div class="d-flex justify-content-star">
                                <h5 class="ml-5"><span style="font-size:larger">Ophtalmologie</span> ..................................... <code style="font-size:larger">{{$ophtalmologie}}</code></h5>
                            </div>
                            <div class="d-flex justify-content-star">
                                <h5 class="ml-5"><span style="font-size:larger">Laboratoire</span> ........................................... <code style="font-size:larger">{{$laboratoire}}</code></h5>
                            </div>
                      
                            <hr>
                            <div class="d-flex justify-content-star">
                                <h5 class="ml-5"><span style="font-size:larger">Bilan général</span> ......................................... <code style="font-size:larger">{{$laboratoire+$ophtalmologie+$cabinetDentaire+$infirmerie+$pharmacie}}</code></h5>
                            </div>
                      
                    
                    

                </div>
            </div>


        </div>
    </div>


</div>



<script>
    
    document.addEventListener('livewire:init', () => {
        Livewire.on('generatePdf', (event) => {
            if (event.pdf != ''){
                let pdfWindow = window.open("");
                pdfWindow.document.write("<iframe width='100%' height='100%' src='data:application/pdf;base64,"+event.pdf+"'></iframe>");
            }
            
        });
    });

</script>