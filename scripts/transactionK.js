const from = document.getElementById("from");
const to = document.getElementById("to");
const kupno = document.getElementById("rate");
const kod = document.getElementById("kod").value;
const API_URL = "https://api.exchangeratesapi.io/latest?base=PLN";

async function transactionKupno(){
    const res = await fetch(API_URL);
    const data = await res.json();
    const rates = data.rates;

    kupno.value = (rates.PLN/rates[kod]).toFixed(4);

        from.addEventListener('keyup', () => {
            to.value = (from.value /kupno.value).toFixed(2);
        });
};
    
transactionKupno();