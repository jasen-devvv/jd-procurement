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

        // Select Status
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

        // Fullcalendar
        var calendarEl = document.getElementById('calendar')
        if(calendarEl) {
            var calendar = new FullCalendar.Calendar(calendarEl, {
                // plugins: ['dayGrid', 'interaction'],
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'title', // Tombol di sisi kiri (hapus 'today' di sini)
                    center: '',  // Bagian tengah: judul bulan/tahun
                    right: 'prev,next' // Opsi tampilan di sisi kanan
                },
            })
            calendar.render()
        }

        // Sweetalert
        var buttonDelete = document.querySelector('.btn-delete')
        var formDelete = document.querySelector('#deleteForm')

        if(buttonDelete) {
            buttonDelete.addEventListener('click', function(e) {
                e.preventDefault()

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Are you sure you want to delete this?',
                    icon: 'warning',
                    showCancelButton: true,
                }).then((result) => {
                    if(result.isConfirmed) {
                        formDelete.submit()
                    }
                })
            })
        }

        // Password Toggle
        var passwordToggle = document.querySelectorAll('.password-toggle');
        if(passwordToggle) {
            passwordToggle.forEach((span) => {
                span.addEventListener('click', function() {
                    const input = span.previousElementSibling;
                    const icon = span.querySelector('i');

                    if(input && icon) {
                        if(input.type === 'password') {
                            input.type = 'text';
                            icon.className = 'bi-eye-fill';
                        } else {
                            input.type = 'password';
                            icon.className = 'bi-eye-slash-fill';
                        }
                    }
                })
            })
        }

        // Toast Bootstrap
        var toastElements = document.querySelectorAll('.toast');
        if(toastElements) {
            toastElements.forEach(function (toastElement) {
                var toast = new bootstrap.Toast(toastElement);
                toast.show(); 
            });
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
                let fullValue;

                if(numberValue) {
                    if(decimalValue) {
                        fullValue = numberValue + '.' + decimalValue
                    } else {
                        fullValue = numberValue + '.00'
                    }
                } else {
                    fullValue = null
                }
                
                rupiahHiddenInputs.value = fullValue
            }
        }
    });    
})();
