<div>

    <div class="page-header bg-primary" style="margin-top:-116px">
        <span id="alerteMessageInfo"></span>
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title row">
                        <h5 class="m-b-10 col-7 col-sm-6 col-md-7 col-lg-7">Profil utilisateur
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card container">
            <div class="card-header">
                <div class="d-flex justify-content-star">
                    <div class="col-12 col-sm-12 col-md-12">
                        <h5><i class="feather icon-user mr-2"></i>Profil</h5>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="">
                                <label class="text-primary" style="font-size: 15px;">Nom et Prenoms</label>
                                <p style="font-size: 18px;">{{optional($user)->nom}} {{optional($user)->prenom}}</p>
                            </div>

                            <div class="">
                                <label class="text-primary" style="font-size: 15px;">Contact</label>
                                <p class="mr-4" style="font-size: 18px;">{{optional($user)->contact}}</p>
                            </div>
                        </div>

                        <div class="col-12 col-sm-12 col-md-6">
                            <div class="">
                                <label class="text-primary" style="font-size: 15px;">Addresse Email</label>
                                <p style="font-size: 18px;">{{optional($user)->email}}</p>
                            </div>
                            <div class="">
                                <label class="text-primary" style="font-size: 15px;">Service</label>
                                <p style="font-size: 18px;">{{optional($user)->role->service}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modif -->
            <div class="row">
                <div class="card container">
                    <div class="card-body">
                        <div class="row text-primary">
                            <div class="col-12 col-sm-12 col-md-8">
                                <h5><i class="feather icon-user mr-2"></i>Modifier profil</h5>
                                <form class="text-primary">
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group fill">
                                                <label for="nom">Nom</label>
                                                <input type="text" wire:model='editUser.nom' id="nom" class="form-control @error('editUser.nom') is-invalid @enderror">
                                                @error('editUser.nom')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group fill">
                                                <label for="prenom">Prenom</label>
                                                <input type="text" id="prenom" wire:model='editUser.prenom' class="form-control @error('editUser.prenom') is-invalid @enderror">
                                                @error('editUser.prenom')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-6">
                                            <div class="form-group fill">
                                                <label for="contact">Contact</label>
                                                <input type="text" wire:model='editUser.contact' id="contact" class="form-control @error('editUser.contact') is-invalid @enderror">
                                                @error('editUser.contact')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>

                                    </div>
                                </form>
                                <div class="d-flex justify-content-star">
                                    <button wire:click.prevent='updateUser()' class="btn btn-sm btn-primary has-ripple">Enregistrer</button>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12 col-md-4">
                                <h5><i class="feather icon-lock mr-2"></i>Modifier le mot de passe</h5>
                                <form>
                                    <div class="row mt-3">
                                        <div class="col-12 col-sm-12 col-md-12">
                                            <div class="form-group fill">
                                                <label for="ancienPassword">Ancien mot de passe</label>
                                                <input type="password" wire:model='password.ancienPassword' id="ancienPassword" class="form-control @error('password.ancienPassword') is-invalid @enderror">
                                                @error('password.ancienPassword')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12">
                                            <div class="form-group fill">
                                                <label for="newPassword">Nouveau mot de passe</label>
                                                <input type="password" wire:model='password.newPassword' id="newPassword" class="form-control @error('password.newPassword') is-invalid @enderror">
                                                @error('password.newPassword')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12 col-md-12">
                                            <div class="form-group fill">
                                                <label for="newPasswordconfirmer">Confirmer le mot de passe</label>
                                                <input type="password" wire:model='password.confirm_newpassword' id="newPasswordconfirmer" class="form-control @error('password.confirm_newpassword') is-invalid @enderror">
                                                @error('password.confirm_newpassword')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <div class="d-flex justify-content-end">
                                    <button wire:click.prevent='updatePassword()' class="btn btn-sm btn-primary has-ripple">Enregistrer</button>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
        document.addEventListener('livewire:init', () => {
        Livewire.on('showSuccessMessage', (event) => {
                alerteMessage('alerteMessageInfo', event.message.type, event.message.message);
        });
    });
</script>