
function disabledButton() {
    document.getElementById("submit").disabled = false;
}

function remplirInputRonde(event) {
    document.getElementById('choix').value = 'Ronde';
    event.preventDefault();

    const img_rond = document.getElementById('awesome-rond');
    img_rond.style.visibility = 'visible';

    const img_rect = document.getElementById('awesome-rect');
    img_rect.style.visibility = 'hidden';

}

function remplirInputRectangulaire(event) {
    document.getElementById('choix').value = 'Rectangulaire';
    event.preventDefault();

    const img_rond = document.getElementById('awesome-rond');
    img_rond.style.visibility = 'hidden';

    const img_rect = document.getElementById('awesome-rect');
    img_rect.style.visibility = 'visible';
}

function remplirInputPente(event) {
    document.getElementById('choix').value = 'Fond progressif';
    event.preventDefault();

    const img_rond = document.getElementById('awesome-plat');
    img_rond.style.visibility = 'hidden';

    const img_rect = document.getElementById('awesome-pente');
    img_rect.style.visibility = 'visible';
}


function remplirInputPlat(event) {
    document.getElementById('choix').value = 'Fond plat';
    event.preventDefault();

    const img_rond = document.getElementById('awesome-plat');
    img_rond.style.visibility = 'visible';

    const img_rect = document.getElementById('awesome-pente');
    img_rect.style.visibility = 'hidden';
}

function remplirInputBlanc(event) {
    document.getElementById('choix').value = 'Blanc';
    event.preventDefault();

    const jaune = document.getElementById('awesome-jaune');
    jaune.style.visibility = 'hidden';

    const rouge = document.getElementById('awesome-rouge');
    rouge.style.visibility = 'hidden';

    const blanc = document.getElementById('awesome-blanc');
    blanc.style.visibility = 'visible';

    const vert = document.getElementById('awesome-vert');
    vert.style.visibility = 'hidden';

    const rose = document.getElementById('awesome-rose');
    rose.style.visibility = 'hidden';

    const bleu = document.getElementById('awesome-bleu');
    bleu.style.visibility = 'hidden';

    const orange = document.getElementById('awesome-orange');
    orange.style.visibility = 'hidden';
}

function remplirInputBleu(event) {
    document.getElementById('choix').value = 'Bleu';
    event.preventDefault();

    const jaune = document.getElementById('awesome-jaune');
    jaune.style.visibility = 'hidden';

    const rouge = document.getElementById('awesome-rouge');
    rouge.style.visibility = 'hidden';

    const blanc = document.getElementById('awesome-blanc');
    blanc.style.visibility = 'hidden';

    const vert = document.getElementById('awesome-vert');
    vert.style.visibility = 'hidden';

    const rose = document.getElementById('awesome-rose');
    rose.style.visibility = 'hidden';

    const bleu = document.getElementById('awesome-bleu');
    bleu.style.visibility = 'visible';

    const orange = document.getElementById('awesome-orange');
    orange.style.visibility = 'hidden';
}

function remplirInputJaune(event) {
    document.getElementById('choix').value = 'Jaune';
    event.preventDefault();

    const jaune = document.getElementById('awesome-jaune');
    jaune.style.visibility = 'visible';

    const rouge = document.getElementById('awesome-rouge');
    rouge.style.visibility = 'hidden';

    const blanc = document.getElementById('awesome-blanc');
    blanc.style.visibility = 'hidden';

    const vert = document.getElementById('awesome-vert');
    vert.style.visibility = 'hidden';

    const rose = document.getElementById('awesome-rose');
    rose.style.visibility = 'hidden';

    const bleu = document.getElementById('awesome-bleu');
    bleu.style.visibility = 'hidden';

    const orange = document.getElementById('awesome-orange');
    orange.style.visibility = 'hidden';
}

function remplirInputRouge(event) {
    document.getElementById('choix').value = 'Rouge';
    event.preventDefault();

    const jaune = document.getElementById('awesome-jaune');
    jaune.style.visibility = 'hidden';

    const rouge = document.getElementById('awesome-rouge');
    rouge.style.visibility = 'visible';

    const blanc = document.getElementById('awesome-blanc');
    blanc.style.visibility = 'hidden';

    const vert = document.getElementById('awesome-vert');
    vert.style.visibility = 'hidden';

    const rose = document.getElementById('awesome-rose');
    rose.style.visibility = 'hidden';

    const bleu = document.getElementById('awesome-bleu');
    bleu.style.visibility = 'hidden';

    const orange = document.getElementById('awesome-orange');
    orange.style.visibility = 'hidden';
}

function remplirInputVert(event) {
    document.getElementById('choix').value = 'Vert';
    event.preventDefault();

    const jaune = document.getElementById('awesome-jaune');
    jaune.style.visibility = 'hidden';

    const rouge = document.getElementById('awesome-rouge');
    rouge.style.visibility = 'hidden';

    const blanc = document.getElementById('awesome-blanc');
    blanc.style.visibility = 'hidden';

    const vert = document.getElementById('awesome-vert');
    vert.style.visibility = 'visible';

    const rose = document.getElementById('awesome-rose');
    rose.style.visibility = 'hidden';

    const bleu = document.getElementById('awesome-bleu');
    bleu.style.visibility = 'hidden';

    const orange = document.getElementById('awesome-orange');
    orange.style.visibility = 'hidden';
}

function remplirInputRose(event) {
    document.getElementById('choix').value = 'Rose';
    event.preventDefault();

    const jaune = document.getElementById('awesome-jaune');
    jaune.style.visibility = 'hidden';

    const rouge = document.getElementById('awesome-rouge');
    rouge.style.visibility = 'hidden';

    const blanc = document.getElementById('awesome-blanc');
    blanc.style.visibility = 'hidden';

    const vert = document.getElementById('awesome-vert');
    vert.style.visibility = 'hidden';

    const rose = document.getElementById('awesome-rose');
    rose.style.visibility = 'visible';

    const bleu = document.getElementById('awesome-bleu');
    bleu.style.visibility = 'hidden';

    const orange = document.getElementById('awesome-orange');
    orange.style.visibility = 'hidden';
}

function remplirInputOrange(event) {
    document.getElementById('choix').value = 'Orange';
    event.preventDefault();

    const jaune = document.getElementById('awesome-jaune');
    jaune.style.visibility = 'hidden';

    const rouge = document.getElementById('awesome-rouge');
    rouge.style.visibility = 'hidden';

    const blanc = document.getElementById('awesome-blanc');
    blanc.style.visibility = 'hidden';

    const vert = document.getElementById('awesome-vert');
    vert.style.visibility = 'hidden';

    const rose = document.getElementById('awesome-rose');
    rose.style.visibility = 'hidden';

    const bleu = document.getElementById('awesome-bleu');
    bleu.style.visibility = 'hidden';

    const orange = document.getElementById('awesome-orange');
    orange.style.visibility = 'visible';
}






