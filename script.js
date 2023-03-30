let charger = document.querySelector("button");
let container = document.querySelector("#container");

charger.addEventListener("click",(event)=>{
    event.preventDefault();
    fetch("http://localhost/Projet_Scroll_Infinite/api.php")
        .then((response)=>{
             return response.json();
        })
        .then((result)=>{
            console.log(result);
            for(let i = 0; i<result.length; i++){
                let card = document.createElement("article");
                let nomPerso = document.createElement("h2");
                let joueur = document.createElement("p");

                nomPerso.innerText = result[i].nom_personnage;
                joueur.innerText = result[i].pseudo_joueur;

                card.append(nomPerso, joueur);
                container.appendChild(card);
            }
        })
        .catch((error)=>{
            let message = document.createElement("h1");
            message.innerText = error;
            container.appendChild(message);
        })
})