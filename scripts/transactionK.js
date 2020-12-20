const from = document.getElementById("from");
const to = document.getElementById("to");
const kupno = document.getElementById("rate");
const kod = document.getElementById("kod").value;
const API_URL = "https://api.exchangeratesapi.io/latest?base=PLN";

async function transactionKupno(){
    const res = await fetch(API_URL);
    const data = await res.json();
    const rates = data.rates;

        from.addEventListener('keyup', () => {
            to.value = (from.value * rates.PLN/rates[kod]).toFixed(2);
        });

        kupno.value = (rates.PLN/rates[kod]).toFixed(4);
};
    
transactionKupno();