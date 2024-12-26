(function () {
    "use strict";

    const formatRupiah = (value) => {
        let number = value.replace(/[^0-9]/g, "");
        return number.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    };

    const formatDecimal = (value) => {
        return value.replace(/[^0-9]/g, "").slice(0, 2);   
    }

    // Quill editor
    const quillEditor = document.querySelector('#quill-editor')
    const quillData = document.querySelector('#quill-data')

    if(quillEditor && quillData) {
        var quill = new Quill('#quill-editor', {
            theme: 'snow',
        })

        quill.on('text-change', function() {
            var content = quill.root.innerHTML
            quillData.value = content
        })
    }  

    document.addEventListener("DOMContentLoaded", function () {
        // Custom Input Rupiah
        const rupiahHiddenInputs = document.querySelector(".rupiah-hidden");
        const rupiahNumberInputs = document.querySelector(".rupiah-number");
        const rupiahDecimalInputs = document.querySelector(".rupiah-decimal");

        if(rupiahHiddenInputs && rupiahNumberInputs && rupiahDecimalInputs) {
            if (rupiahHiddenInputs.value) {
                const [numberPart, decimalPart] = rupiahHiddenInputs.value.split('.')

                rupiahNumberInputs.value = formatRupiah(numberPart || "0")
                rupiahDecimalInputs.value = formatDecimal(decimalPart || "00")
            }
        }

        const selectStatus = document.querySelector('#select-status')
        
        if(selectStatus) {
            selectStatus.addEventListener('change', function(e) {
                var rejectElement = document.querySelector('#rejection_reason')
                if(e.target && e.target.value == 'reject') {
                    rejectElement.parentElement.classList.remove('d-none')
                    rejectElement.parentElement.classList.add('d-block')
                } else {
                    rejectElement.parentElement.classList.remove('d-block')
                    rejectElement.parentElement.classList.add('d-none')
                }
            })
        }
    });

    document.body.addEventListener("input", function (e) {        
        if (e.target && e.target.classList.contains("rupiah-number")) {
            let value = e.target.value.replace(/[^0-9]/g, "");
            let formatted = formatRupiah(value);
            e.target.value = formatted;
        } 
        
        if (e.target && e.target.classList.contains("rupiah-decimal")) {
            let value = e.target.value.replace(/[^0-9]/g, "");
            let formatted = formatDecimal(value);
            e.target.value = formatted;
        }
    });

    document.body.addEventListener("submit", function (e) {
        if (e.target && e.target.tagName.toLowerCase() === "form") {
            const rupiahHiddenInputs = e.target.querySelector(".rupiah-hidden");
            const rupiahNumberInputs = e.target.querySelector(".rupiah-number");
            const rupiahDecimalInputs = e.target.querySelector(".rupiah-decimal");
            
            if (rupiahNumberInputs && rupiahDecimalInputs) {
                let numberValue = rupiahNumberInputs.value.replace(/\./g, '')
                let decimalValue = rupiahDecimalInputs.value.replace(/,/g, '')
                let fullValue = numberValue + '.' + decimalValue
                
                rupiahHiddenInputs.value = fullValue
            }
        }
    });    
})();
