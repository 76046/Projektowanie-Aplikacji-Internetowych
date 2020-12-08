const from = document.getElementById("from");
const to = document.getElementById("to");
const fromAmount = document.getElementById("fromAmount");
const toAmount = document.getElementById("toAmount");
const API_URL = "https://api.exchangeratesapi.io/latest";
let html = '';
            
async function currency(){
const res = await fetch(API_URL);
const data = await res.json();
const rates = data.rates;
const arrKeys = Object.keys(rates);
arrKeys.map(item => {
    return html += `<option value=${item}>${item}</option>`;
});
for(let i = 0; i<from.length; i++){
    from.innerHTML = html;
    to.innerHTML = html;
};

    fromAmount.addEventListener('keyup', () => {
        toAmount.value = (fromAmount.value * rates[to.value] / rates[from.value]).toFixed(2);
    });
    // toAmount.addEventListener('keyup', () => {
    //     fromAmount.value = (toAmount.value * rates[from.value] / rates[to.value]).toFixed(2);
    // });
    from.addEventListener('change', () => {
        toAmount.value = (fromAmount.value * rates[to.value] / rates[from.value]).toFixed(2);
    });
    to.addEventListener('change', () => {
        // fromAmount.value = (toAmount.value * rates[from.value] / rates[to.value]).toFixed(2);
        toAmount.value = (fromAmount.value * rates[to.value] / rates[from.value]).toFixed(2);
    });
};

currency();