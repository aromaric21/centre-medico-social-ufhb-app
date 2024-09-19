<div class="row">

    <div class="card container">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12">
                    <h5><i class="feather icon-users mr-2"></i>Liste des consultation : <code style="font-size: 18px">{{count($consultations->get())}}</code>
                        @if (count($consultations->get())>1)
                            consultations
                        @else
                            consultation
                        @endif
                    </h5>
                </div>
            </div>
            
            <div class="justify-content-between d-flex">
                <div class="">
                    <select class="form-control" wire:model.live.debounce="service">
                        <option value="">Service</option>
                        @foreach ($roles as $role)
                            @if ( !in_array($role->libelleRole,["Admin","Secrétaire","Pharmacien","Caissière"]))
                            <option value="{{$role->service}}">{{$role->service}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="">
                    <div class="justify-content-center d-flex">
                        <input type="date" wire:model.live.debounce="date"
                            class="form-control">
                    </div>
                </div>
                <div class="">
                    <div class="justify-content-center d-flex">
                        <input type="text" name="recherche" wire:model.live.debounce="docteur"
                            class="form-control col-7 col-lg-7 col-sm-8 col-md-8"
                            placeholder="Docteur">
                        <span class="fa fa-search col-2 col-lg-2 col-sm-2 col-md-2 mt-3"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="striped">
                    <thead>
                        <tr>
                            <th class="text-center">Date</th>
                            <th class="text-center">Docteur</th>
                            <th class="text-center">Service</th>
                            <th class="text-center">Enregistrer</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultations->paginate(5) as $consultation)
                        <tr>
                            <td class="text-center">{{dateTime($consultation->dateConsultation)}}</td>
                            <td class="text-center">{{$consultation->prenom}} {{$consultation->nom}}</td>
                            <td class="text-center">{{$consultation->service}}</td>
                            <td class="text-center">{{$consultation->created_at->diffForHumans()}}</td>

                            <td class="text-center">
                               
                                <button class="btn btn-link" wire:click='detailConsultation("{{$consultation->id}}")'
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
            {{$consultations->paginate(5)->onEachSide(1)->links()}}
        </div>
    </div>

</div>



<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('showModal', (event) => {
           $(`#${event.message}`).modal("show")
           console.log(event.message);
       });
   });

   document.addEventListener('livewire:init', () => {
       Livewire.on('closeModal', (event) => {
           $(`#${event.message}`).modal("hide")
       });
   });
</script>