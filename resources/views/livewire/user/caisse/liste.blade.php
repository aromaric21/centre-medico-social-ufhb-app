<div class="row">
    <div class="card container">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <h5><i class="feather icon-users"></i>Liste des Dépenses : <code style="font-size: 18px">{{count($depenses)}}</code>
                        @if (count($depenses)>1)
                        Dépenses
                        @else
                        Dépense
                        @endif
                    </h5>
                </div>
                

            </div>

            <div class="row d-flex justify-content-between">
                
                <div class="ml-5 mt-2">
                    <div class="justify-content-center d-flex">
                        
                        <div class="justify-content-center d-flex ml-3">
                            
                            <input type="date" name="recherche" wire:model.live.debounce="search"
                            class="form-control col-7 col-lg-10 col-sm-10 col-md-10">
                            <span class="fa fa-search col-2 col-lg-2 col-sm-2 col-md-2 mt-3"></span>
                        
                        </div>
                    </div>
                </div>
                @can("caissier")
                    <div class="">
                        <button class="btn btn-outline-primary btn-sm mt-3" wire:click='goToCreateNewDepense()'>
                            <i class="feather icon-user-plus"></i> Nouvelle dépense</button>
                    </div>
                @endcan
            </div>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="striped">
                    <thead>
                        <tr>
                            <th class="text-center">Date</th>
                            <th class="text-center">Pharmacie</th>
                            <th class="text-center">Cabinet dentaire</th>
                            <th class="text-center">Infirmerie</th>
                            <th class="text-center">Examen laboratoire</th>
                            <th class="text-center">Ophtalmologie</th>
                            <th class="text-center">Ajouter</th>
                            @can("caissier")
                            <th class="text-center">Action</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($depenses as $depense)
                        <tr>
                            <td class="text-center">{{dateTime($depense->created_at)}}</td>
                            <td class="text-center">{{$depense->pharmacie}}</td>
                            <td class="text-center">{{$depense->dentaire}}</td>
                            <td class="text-center">{{$depense->infirmerie}}</td>
                            <td class="text-center">{{$depense->biologie}}</td>
                            <td class="text-center">{{$depense->ophtalmologie}}</td>
                            <td class="text-center">{{optional($depense->created_at)->diffForHumans()}}</td>

                            @can("caissier")
                            <td class="text-center">
                                <button class="btn btn-link"
                                    wire:click='goToEditDepense("{{$depense->id}}")'>
                                    <!-- https://feathericons.dev/?search=edit&iconset=feather -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                        class="main-grid-item-icon" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>

                                </button>

                                <button class="btn btn-link"
                                    wire:click='confirmeDelete("{{$depense->id}}")'>
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
                        

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{$depenses->links()}}
        </div>
    </div>

</div>