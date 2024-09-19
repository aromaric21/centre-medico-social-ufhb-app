<div>


    @if ($currentPage == PAGELISTCONSULTATION)
        @include('livewire.user.historique.consultation.liste')
    @endif

    @if ($currentPage == PAGEDETAILCONSULTATION)
        @include('livewire.user.historique.consultation.detail')
    @endif
 
</div>


<script>
    
    document.addEventListener('livewire:init', () => {
        Livewire.on('generatePdf', (event) => {
            if (event.pdf != ''){
                let pdfWindow = window.open("");
                pdfWindow.document.write("<iframe width='100%' height='100%' src='data:application/pdf;base64,"+event.pdf+"'></iframe>");
            }
            
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




