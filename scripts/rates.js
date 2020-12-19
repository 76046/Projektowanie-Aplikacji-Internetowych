const kupnoInput = document.querySelectorAll(".kupno-input");
const sprzedazInput = document.querySelectorAll(".sprzedaz-input");
const kupnoWaluty = document.querySelectorAll(".kupno-waluty");
const sprzedazWaluty = document.querySelectorAll(".sprzedaz-waluty");
const kodWaluty = document.querySelectorAll(".kod-input");
//const przycisk = document.getElementById("aktualizuj");
const API_URL = "https://api.exchangeratesapi.io/latest?base=PLN";
            
async function updateRates(){
    const res = await fetch(API_URL);
    const data = await res.json();
    const rates = data.rates;

    // przycisk.addEventListener('click', () => {
        for(let i = 0; i<kupnoInput.length; i++){
            var kod = kodWaluty[i].value;
            kupnoInput[i].value = (1/rates[kod]).toFixed(4);
            if(kupnoInput[i].value == 0.00){
                kupnoInput[i].value = 0.01;
            }
            sprzedazInput[i].value = (1/rates[kod]+0.05).toFixed(4);
            kupnoWaluty[i+1].innerHTML += kupnoInput[i].value;
            sprzedazWaluty[i+1].innerHTML += sprzedazInput[i].value;
        };
    // });
};

setInterval(updateRates(), 300000);