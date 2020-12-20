const from = document.getElementById("from");
const to = document.getElementById("to");
const sprzedaz = document.getElementById("rate");
const kod = document.getElementById("kod").value;
const API_URL = "https://api.exchangeratesapi.io/latest?base=PLN";

async function transactionSprzedaz(){
    const res = await fetch(API_URL);
    const data = await res.json();
    const rates = data.rates;

        from.addEventListener('keyup', () => {
            to.value = (from.value * rates.PLN / rates[kod]+0.05).toFixed(2);
        });

        sprzedaz.value = (rates.PLN/rates[kod]+0.05).toFixed(4);
};
    
transactionSprzedaz();