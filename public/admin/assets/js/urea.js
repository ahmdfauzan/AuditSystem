document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('.urea-input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                const sisa = parseFloat(this.getAttribute('data-sisa'));
                const percentage = parseFloat(this.value);
                const rowId = this.getAttribute('data-row');
                if (!isNaN(sisa) && !isNaN(percentage)) {
                    const result = (sisa * percentage) / 100;
                    const formattedResult = result.toFixed(0);
                    const percentageResultDiv = this.closest('td').querySelector('.percentage-result');
                    percentageResultDiv.innerHTML = `<small>${formattedResult}</small>`;
                    this.closest('td').querySelector('.urea-result').value = formattedResult;
                    let totalInput = 0;
                    document.querySelectorAll(`[name^='urea_value_'][data-row="${rowId}"]`).forEach(input => {
                        totalInput += parseFloat(input.value) || 0;
                    });
                    document.getElementById(`input-total-${rowId}`).innerText = `${totalInput.toFixed(1)}`;
                    const updateButton = document.querySelector(`.update-button[data-id="${rowId}"]`);
                    updateButton.disabled = totalInput !== 100;
                } else {
                    const percentageResultDiv = this.closest('td').querySelector('.percentage-result');
                    percentageResultDiv.innerHTML = '';
                    document.getElementById(`input-total-${rowId}`).innerText = '-';
                    const updateButton = document.querySelector(`.update-button[data-id="${rowId}"]`);
                    updateButton.disabled = true;
                }
            });
        });

        document.querySelectorAll('.update-button').forEach(button => {
            button.addEventListener('click', function() {
                const rowId = this.getAttribute('data-id');
                const row = document.querySelector(`#data-row-${rowId}`);
                const inputs = row.querySelectorAll('.urea-input');
                inputs.forEach(input => {
                    if (input.value === '') {
                        input.value = 0;
                    }
                });
                const form = document.getElementById('urea-main-form');
                const formData = new FormData(form);
                const spinner = document.getElementById('loading-spinner');
                spinner.style.display = 'block';
                fetch(`{{ route('saveUreaBatch') }}`, {
                    method: 'POST',
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6',
                            timerProgressBar: true,
                            willClose: () => {
                            location.reload();
                        }
                        });
                    } else {
                        Swal.fire({
                            title: "Error!",
                            text: "Terjadi kesalahan saat memperbarui data.",
                            icon: "error",
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#d33'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                            title: "Good job!",
                            text: "You clicked the button!",
                            icon: "success",
                            confirmButtonText: 'OK',
                            confirmButtonColor: '#3085d6',
                            timerProgressBar: true,
                            willClose: () => {
                            location.reload();
                        }
                        });
                })
                .finally(() => {
                    spinner.style.display = 'none';
                });
            });
        });
    });

    