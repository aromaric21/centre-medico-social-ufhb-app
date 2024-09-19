<div class="row">
    <div class="card container">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-5">
                    <h5 ><i class="feather icon-users mr-2"></i>Liste des utilisateurs : <span id="nbreUsers"></span> utilisateur</h5>
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    <form method="post" id="formRechercherUser" class="form-group form-inline row fill">
                        <input type="text" name="recherche" class="form-control col-7 col-lg-7 col-sm-8 col-md-8" id="recherche" placeholder="Nom ou Prenom"> <span class="fa fa-search col-2 col-lg-2 col-sm-2 col-md-2"></span>
                    </form>
                </div>
                <div class="col-12 col-sm-12 col-md-3">
                    <button class="btn btn-outline-primary btn-sm" wire:click.prevent='goToAddUser()'><i class="feather icon-user-plus"></i> Ajouter un utilisateur</button>
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom et prenoms</th>
                            <th class="text-center">Contact</th>
                            <th class="text-center">Mail</th>
                            <th class="text-center">Service</th>
                            <th class="text-center">Ajouter</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td></td>
                                <td>{{$user->prenom}} {{$user->nom}}</td>
                                <td class="text-center">{{$user->contact}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                <td class="text-center">{{$user->role->service}}</td>
                                <td class="text-center">{{$user->created_at->diffForHumans()}}</td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click='goToEditUser("{{$user->id}}")'><i class="feather icon-edit"></i></button>
                                    <button class="btn btn-link" wire:click='confirmeDesactiveOrActiveUser("{{$user->prenom}} {{$user->nom}}", "{{$user->id}}")'><i class="feather {{$user->etatCompte==1 ? ' icon-thumbs-up' : ' icon-thumbs-down'}}"></i></button>
                                    
                                </td>
                            </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{$users->links()}}
        </div>
    </div>
</div>
