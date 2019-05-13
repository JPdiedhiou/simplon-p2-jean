document.addEventListener('DOMContentLoaded', function() {
    /*Pour chaque th dans table
    Je collecte les labels
    Pour chaque tableau table*/
    document.querySelectorAll('.table-responsive').forEach(function(table) {
        let labels = Array.from(table.querySelectorAll('th')).map(fucntion(th));
        return th.innerText;
    })

    /*Pour chaque td de chaque table
    On recupere l'index du td
    On va mettre le data-label qui correspond*/
    table.querySelectorAll('td').forEach(function(td, i) {
        td.setAttribute('data-label', labels[i % labels.length]);
    })
})