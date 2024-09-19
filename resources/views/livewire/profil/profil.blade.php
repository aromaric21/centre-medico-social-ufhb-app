<div>






    <div class="row">
        <div class="col-6">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-7">
                    <div class="">
                        <label class="text-primary" style="font-size: 15px;">Nom et Prenoms</label>
                        <p style="font-size: 18px;">{{optional($user)->nom}} {{optional($user)->prenom}}</p>
                    </div>

                    <div class="">
                        <label class="text-primary" style="font-size: 15px;">Contact</label>
                        <p class="mr-4" style="font-size: 18px;">{{optional($user)->contact}}</p>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-5">
                    <div class="">
                        <label class="text-primary" style="font-size: 15px;">Addresse Email</label>
                        <p style="font-size: 18px;">{{optional($user)->email}}</p>
                    </div>
                    <div class="">
                        <label class="text-primary" style="font-size: 15px;">Service</label>
                        <p style="font-size: 18px;">{{optional($user)->role()->service}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-7">
                    <div class="">
                        <label class="text-primary" style="font-size: 15px;">Profession</label>
                        <p style="font-size: 18px;">{{optional($lastInfoConsultationPatient)->profession}}</p>
                    </div>

                    <div class="">
                        <label class="text-primary" style="font-size: 15px;">Assurer</label>
                        <p style="font-size: 18px;">{{optional($lastInfoConsultationPatient)->assure}}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modif -->
        <div class="row">
            <div class="card container">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <div class="col-12 col-sm-12 col-md-5">
                            <h5><i class="feather icon-user-plus mr-2"></i>Profil</h5>
                        </div>
                        <div class="col-12 col-sm-12 col-md-3">
                            <button class="btn btn-outline-primary btn-sm" wire:click.prevent='goToListeUser()'><i class="feather icon-users"></i> Liste utilisateur</button>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent='addUser()'>
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="form-group fill">
                                    <label for="nom">Nom</label>
                                    <input type="text" wire:model='newUser.nom' id="nom" class="form-control @error('newUser.nom') is-invalid @enderror">
                                    @error('newUser.nom')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group fill">
                                    <label for="prenom">Prenom</label>
                                    <input type="text" id="prenom" wire:model='newUser.prenom' class="form-control @error('newUser.prenom') is-invalid @enderror">
                                    @error('newUser.prenom')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="form-group fill">
                                    <label for="contact">Contact</label>
                                    <input type="text" wire:model='newUser.contact' id="contact" class="form-control @error('newUser.contact') is-invalid @enderror">
                                    @error('newUser.contact')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="form-group fill">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" wire:model='newUser.email' class="form-control @error('newUser.email') is-invalid @enderror">
                                    @error('newUser.email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-sm btn-primary has-ripple">Enregistrere</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>