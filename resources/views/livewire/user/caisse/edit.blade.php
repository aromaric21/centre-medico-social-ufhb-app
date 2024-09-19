<div class="row">
    <div class="card container">
        <div class="card-header">
                

            <div class="row d-flex justify-content-between">
                <div class="">
                    <h5>Ajouter une dépense</h5>
                </div>
                <div class="">
                    <button class="btn btn-outline-primary btn-sm mt-3" wire:click='goToListeDepense()'>
                        <i class="feather icon-user-plus"></i> Liste dépense</button>
                </div>
            </div>

        </div>
        <div class="card-body">
            <form wire:submit.prevent='editDepense()'>
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="form-group fill">
                            <label for="infirmerie" class="text-primary">Infirmerie</label>
                            <input type="number" min="0" id="infirmerie" wire:model='newDepense.infirmerie' class="form-control @error('newDepense.infirmerie') is-invalid @enderror">
                            @error('newDepense.infirmerie')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group fill">
                            <label for="biologie" class="text-primary">Examen laboratoire</label>
                            <input type="number" min="0" id="biologie" wire:model='newDepense.biologie' class="form-control @error('newDepense.biologie') is-invalid @enderror">
                            @error('newDepense.biologie')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group fill">
                            <label for="dentaire" class="text-primary">Cabinet dentaire</label>
                            <input type="number" min="0" wire:model='newDepense.dentaire' id="dentaire" class="form-control @error('newDepense.dentaire') is-invalid @enderror">
                            @error('newDepense.dentaire')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12 col-sm-4">
                        <div class="form-group fill">
                            <label for="ophtalmologie" class="text-primary">Ophtalmologie</label>
                            <input type="number" min="0" wire:model='newDepense.ophtalmologie' id="ophtalmologie" class="form-control @error('newDepense.ophtalmologie') is-invalid @enderror">
                            @error('newDepense.ophtalmologie')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-sm-4">
                        <div class="form-group fill">
                            <label for="pharmacie" class="text-primary">Pharmacie</label>
                            <input type="text" wire:model='newDepense.pharmacie' id="pharmacie" class="form-control @error('newDepense.pharmacie') is-invalid @enderror">
                            @error('newDepense.pharmacie')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-sm-4">
                        <div class="form-group fill">
                            <label for="numeroFiche" class="text-primary">Numero du patient</label>
                            <input type="text" wire:model='newDepense.numeroFiche' id="numeroFiche" class="form-control @error('newDepense.numeroFiche') is-invalid @enderror">
                            @error('newDepense.numeroFiche')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary has-ripple">Enregistrere</button>
                </div>
            </form>
        </div>
    </div>
    
</div>