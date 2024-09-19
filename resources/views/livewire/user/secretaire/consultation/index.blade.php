<div>

    <div class="page-header bg-primary" style="margin-top:-116px">
        <span id="alerteMessageInfo"></span>
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title row">
                        <h5 class="m-b-10 col-7 col-sm-6 col-md-7 col-lg-7">Liste consultations
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($currentPage == PAGELISTCONSULTATION)
        @include('livewire.user.secretaire.consultation.liste')
    @endif

    @if ($currentPage == PAGEDETAILCONSULTATION)
        @include('livewire.user.secretaire.consultation.detail')
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
                    if(event.message.typeConfirm == 'delete'){
                        @this.deleteUser(event.message.user_id)
                    }
                    if(event.message.typeConfirm == 'desactiveOrActive'){
                        @this.desactiveOrActiveUser(event.message.user_id)
                    }
                    
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

<script>
    document.addEventListener('livewire:init', () => {
       Livewire.on('showModal', (event) => {
           $(`#${event.message}`).modal("show")
       });
   });

   document.addEventListener('livewire:init', () => {
       Livewire.on('closeModal', (event) => {
           $(`#${event.message}`).modal("hide")
       });
   });
</script>







