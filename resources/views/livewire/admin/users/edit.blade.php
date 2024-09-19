<div class="row">
    <div class="card container">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div class="col-12 col-sm-12 col-md-5">
                    <h5 ><i class="feather icon-user-plus mr-2"></i>Editer un utilisateur</h5>
                </div>
                <div class="col-12 col-sm-12 col-md-3">
                    <button class="btn btn-outline-primary btn-sm" wire:click.prevent='goToListeUser()'><i class="feather icon-users"></i> Liste utilisateur</button>
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <form wire:submit.prevent='apdateUser()'>
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="form-group fill">
                            <label for="nom">Nom</label>
                            <input type="text" wire:model='editUser.nom' id="nom" class="form-control @error('editUser.nom') is-invalid @enderror">
                            @error('editUser.nom')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group fill">
                            <label for="prenom">Prenom</label>
                            <input type="text" id="prenom" wire:model='editUser.prenom' class="form-control @error('editUser.prenom') is-invalid @enderror">
                            @error('editUser.prenom')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="form-group fill">
                            <label for="contact">Contact</label>
                            <input type="text" wire:model='editUser.contact' id="contact" class="form-control @error('editUser.contact') is-invalid @enderror">
                            @error('editUser.contact')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <div class="form-group fill">
                            <label for="email">Email</label>
                            <input type="email" id="email" wire:model='editUser.email' class="form-control @error('editUser.email') is-invalid @enderror">
                            @error('editUser.email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-sm-6">
                        <div class="form-group fill">
                            <label for="service">Service</label>
                            <select wire:model='editUser.role_id' id="service" class="form-control @error('editUser.role_id') is-invalid @enderror">
                                <option value=""></option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->service}}</option>
                                @endforeach
                            </select>
                            @error('editUser.role_id')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <button type="submit" class="btn btn-sm btn-primary has-ripple">Appliquer les modification</button>
                </div>
            </form>
        </div>
        
    </div>
</div>
