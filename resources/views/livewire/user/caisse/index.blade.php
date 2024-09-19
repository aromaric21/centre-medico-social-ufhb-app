<div>

    <div class="page-header bg-primary" style="margin-top:-116px">
        <span id="alerteMessageInfo"></span>
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title row">
                        <h5 class="m-b-10 col-7 col-sm-6 col-md-7 col-lg-7">Caisse
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($currentPage == PAGELISTDEPENSE)
        @include('livewire.user.caisse.liste')
    @endif

    @if ($currentPage == PAGECREATE)
        @include('livewire.user.caisse.create')
    @endif

    @if ($currentPage == PAGEEDITDEPENSE)
        @include('livewire.user.caisse.edit')
    @endif
 
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
                    @this.deleteDepense(event.message.id)
                }
            });
       });
    });

    document.addEventListener('livewire:init', () => {
        Livewire.on('showSuccessMessage', (event) => {
                alerteMessage('alerteMessageInfo', event.message.type, event.message.message);
        });
    });

   
</script>







