
<div>
    <div class="page-header bg-primary" style="margin-top:-116px">
        <span id="alerteMessageInfo"></span>
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title row">
                        <h5 class="m-b-10 col-7 col-sm-6 col-md-7 col-lg-7">Utilisateurs
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card container">
            <div class="card-header">
                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <h5><i class="feather icon-users"></i>Liste des medicaments : <code style="font-size: 18px">{{count($medicaments)}}</code>
                            @if (count($medicaments)>1)
                            medicaments
                            @else
                            medicament
                            @endif
                        </h5>
                    </div>
                    

                </div>

                <div class="row d-flex justify-content-between">
                    
                    <div class="ml-5 mt-2">
                        <div class="justify-content-center d-flex">
                            <div>
                                <select id="triParDisponibilite" wire:model.live.debounce="disponibilite" class="form-control">
                                    <option value="">Recherche par stock</option>
                                    <option value="stockRupture">Rupture en stock</option>
                                    <option value="stockDisponible">Disponible en stock</option>
                                    <option value="ruptureRayon">Rupture en rayon</option>
                                    <option value="disponibleRayon">Disponible en rayon</option>
                                    <option value="stockDispoAndDispoRayon">Disponible en stock et disponible en rayon</option>
                                    <option value="stockRuptureAndRuptureRayon">Rupture en stock et Rupture en rayon</option>
                                </select>
                            </div>
                            <div class="justify-content-center d-flex ml-3">
                                
                                <input type="text" name="recherche" wire:model.live.debounce="search"
                                class="form-control col-7 col-lg-10 col-sm-10 col-md-10"
                                placeholder="Nom du medicament">
                                <span class="fa fa-search col-2 col-lg-2 col-sm-2 col-md-2 mt-3"></span>
                            
                            </div>
                            <div>
                                <button wire:click="generatePDF()" class="btn btn-sm btn-outline-primary fa fa-download mt-3 ml-5" title="Telecharger rapport"></button>
                            </div>
                        </div>
                    </div>
                    @can("pharmacien")
                    <div class="">
                        <button class="btn btn-outline-primary btn-sm mt-3" wire:click='showAddMedicamentForm()'>
                            <i class="feather icon-user-plus"></i> Nouveau medicament</button>
                    </div>
                    @endcan
                    
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5%"></th>
                                <th style="width: 25%">Medicament</th>
                                <th class="text-center" style="width: 20%">Stock</th>
                                <th class="text-center" style="width: 25%">Disponibilité en rayon</th>
                                @can("pharmacien")
                                <th class="text-center" style="width: 25%">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @can("pharmacien")
                                @if ($isAddMedicament==true)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <input type="text" class="form-control @error('medicament.nomMedicament') is-invalid @enderror" 
                                                wire:model="medicament.nomMedicament" placeholder="Nom du medicament">
                                            @error('medicament.nomMedicament')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" min="0" class="form-control @error('medicament.stock') is-invalid @enderror" 
                                                wire:model="medicament.stock" placeholder="Stock">
                                            @error('medicament.stock')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" min="0" class="form-control @error('medicament.disponibleRayon') is-invalid @enderror" 
                                                wire:model="medicament.disponibleRayon" placeholder="Disponible en rayon">
                                            @error('medicament.disponibleRayon')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn  btn-sm btn-danger mt-2"
                                            wire:click='hideAddMedicamentForm()'>Annuler</button>
                                        <button type="button" class="btn btn-sm btn-primary mt-2"
                                            wire:click.prevent="{{$isEditMedicament==true ? 'addNewStock()' : 'addMedicament()'}}">Enregistrer</button>
                                        </td>
                                    </tr>
                                @endif
                            @endcan
                            @if ($isEditMedicament==false)
                                @foreach ($medicaments as $medicament)
                                    <tr>
                                        <td class="text-center">
                                        </td>
                                        <td>{{$medicament->nomMedicament}}</td>
                                        <td class="text-center">{{$medicament->stock}}</td>
                                        <td class="text-center">{{$medicament->disponibleRayon}}</td>
                                        @can("pharmacien")
                                            <td class="text-center">
                                                <button class="btn btn-link"
                                                    wire:click='showEditMedicamentForm("{{$medicament->id}}")'>
                                                    <!-- https://feathericons.dev/?search=edit&iconset=feather -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                                        class="main-grid-item-icon" fill="none" stroke="currentColor"
                                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                    </svg>

                                                </button>

                                                <button class="btn btn-link"
                                                    wire:click='confirmeDelete("{{$medicament->nomMedicament}}", "{{$medicament->id}}")'>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>

                                                </button>
                                                
                                            </td>
                                        @endcan
                                    </tr>
                                @endforeach
                            @endif
                            

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{$medicaments->onEachSide(1)->links()}}
            </div>
        </div>

    </div>
</div>

<script>

    document.addEventListener('livewire:init', () => {
       Livewire.on('showConfirmMessage', (event) => {

            Swal.fire({
                title: "Etes-vous sur de continuer?",
                text: event.message.message,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Continure",
                cancelButtonText: "Annuler"
                }).then((result) => {
                if (result.isConfirmed) {
                    @this.deleteMedicament(event.message.id)
                    
                }
            });
       });
    });

    document.addEventListener('livewire:init', () => {
        Livewire.on('showSuccessMessage', (event) => {
                alerteMessage('alerteMessageInfo', event.message.type, event.message.message);
        });
    });

    document.addEventListener('livewire:init', () => {
        Livewire.on('generatePdf', (event) => {
            if (event.pdf != ''){
                let pdfWindow = window.open("");
                pdfWindow.document.write("<iframe width='100%' height='100%' src='data:application/pdf;base64,"+event.pdf+"'></iframe>");
            }
            
        });
    });

</script>