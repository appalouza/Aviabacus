function CalculAge() {
    var td=new Date();// Le date d'ouverture de la page (aujourd'hui)
    var dtn=document.getElementById('DateNais').value; // on lit la date de naissance
    var an=dtn.substr(0,4); // l'année (les quatre premiers caractères de la chaîne à partir de 6)
    var mois=dtn.substr(5,2)-1;// On selectionne le mois de la date de naissance
    var day= dtn.substr(8,2); // On selectionne la jour de la date de naissance
    var age=td.getFullYear()-an; // l'âge du patient

    var mMois=td.getMonth()-mois; // On calcul  le mois de la date - le mois de la date de naissance


    if(mMois < 0) // s'il est strictement inferieur a 0
    {
        age=age-1; // On enléve 1 ans a l'age
    }
    else
    {
        if(mMois == 0)// s'il égal 0 on est sur le même mois
        {
            var dateJour = td.getDay();
            var mDate=td.getDate()-day;
            //document.write(mDate);
            if(mDate < 0)
            {
                age=age-1;
            }

        }
    }

    document.getElementById('Age').value=age; // que l'on place dans le input d'id Age
}