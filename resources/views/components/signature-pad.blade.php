<div x-data="signaturePad(@entangle($attributes->wire('model')))">
    <div>
        <canvas x-ref="signature_canvas" class="border rounded shadow">

        </canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js"></script>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('signaturePad', (value) => ({
            signaturePadInstance: null,
            value: value,
            clear() {
                this.signaturePadInstance = new SignaturePad(this.$refs.signature_canvas)
            },
            init(){
                this.clear()
                this.signaturePadInstance.addEventListener("endStroke", ()=>{
                    this.value = this.signaturePadInstance.toDataURL('image/png');
                });
                window.livewire.on('clear', () => {
                    this.clear()
                })
            },
        }))
    })
</script>
