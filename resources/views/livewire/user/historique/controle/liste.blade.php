<div>

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12 mt-1">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Historique</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route("home")}}"><i class="feather icon-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route("consultation.index")}}">Liste des patients</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{route("historique.consultation.index",$consultation->patient_id)}}">Liste des
                            consultation</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Liste des controles</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="card container">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-5">
                    <h5>
                        <i class="feather icon-file-text mr-2"></i>Liste de controles de <code style="font-size: 18px"> {{$consultation->patient->nomPrenom}} </code> : {{count($controles)}}
                        @if (count($controles)>1)
                            controles
                        @else
                            controle
                        @endif
                    </h5>
                </div>
                <div class="col-12 col-sm-12 col-md-4">
                    <div class="justify-content-center d-flex">
                        <input type="date" name="recherche" wire:model.live.debounce="search"
                            class="form-control col-7 col-lg-7 col-sm-8 col-md-8">
                        <span class="fa fa-search col-2 col-lg-2 col-sm-2 col-md-2 mt-3"></span>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-md-3">
                    <a href="{{route("historique.consultation.index",$consultation->patient_id)}}" class="btn btn-outline-primary btn-sm"><i
                            class="feather icon-users"></i> Liste consultations</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="striped">
                    <thead>
                        <tr>
                            <th style="width: 5%"></th>
                            <th style="width: 20%">DATE DE CONTROLE</th>
                            <th class="text-center" style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($controles as $controle)
                        <tr>
                            <td></td>
                            <td>{{dateTime($controle->dateControle)}}</td>

                            <td class="text-center">
                                <button class="btn btn-link" wire:click='detailControle("{{$controle->id}}")'
                                    title="Detail">

                                    <!-- https://feathericons.dev/?search=file-plus&iconset=feather -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
                                        class="main-grid-item-icon" fill="none" stroke="currentColor"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                        <line x1="12" x2="12" y1="18" y2="12" />
                                        <line x1="9" x2="15" y1="15" y2="15" />
                                    </svg>

                                </button>

                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{$controles->links()}}
        </div>
    </div>

</div>