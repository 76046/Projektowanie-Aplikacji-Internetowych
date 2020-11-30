async function currencyConverter(){
    var from = Document.getElementById("from").value;
    var to = Document.getElementById("to").value;
    var fromAmount = Document.getElementById("fromAmount").value;
    var toAmount = Document.getElementById("toAmount").value;

    const API_URL = "https://api.exchangeratesapi.io/latest";
    let html = '';
    const res = await fetch(API_URL);
    const data = await res.json();
    const rates = data.rates;
    const arrKeys = Object.keys(rates);
    arrKeys.map(item => {
        return html += `<option value=${item}>${item}</option>`;
    });
    for(let i=0; i<from.length; i++){
        from[i].innerHTML = html;
        to[i].innerHTML = html;
    };

    var dzielenie = rates[to] / rates[from];
    toAmount = (fromAmount*dzielenie).toFixed(2);
}