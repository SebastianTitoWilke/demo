<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wilke Designs - Demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div id="app">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <img src="logo.png" width="50">
                </div>
                <div class="col-md-3">
                </div>
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Name</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="24" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                                </svg>
                            </span>
                        </div>
                        <input @change="update()" class="form-control" placeholder="Max Mustermann" v-model="name" type="text">
                    </div>
                    <label>eMail</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input @change="update()" class="form-control" placeholder="max.mustermann@none.de" v-model="email" type="email">
                    </div>    
                    <label>From</label>
                    <input @change="update()" class="form-control" placeholder="2000-01-01" v-model="from" type="date">
                    <label>Until</label>
                    <input @change="update()" class="form-control" placeholder="2025-01-01" v-model="until" type="date">
                    <label>Color</label>
                    <input @change="update()" class="form-control" placeholder="#affee" v-model="color" type="color">
                    <label>Select</label>
                    <select v-model="selected" class="form-control">    
                        <option value="">Auswahl</option>  
                        <option value="Option1">Option 1</option>
                        <option value="Option2">Option 2</option>
                        <option value="Option3">Option 3</option>
                        <option value="Option4">Option 4</option>
                        <option value="Option5">Option 5</option>    
                    </select>
                </div>
                <div class="col-md-3 hallo">
                </div>
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
        </div>
    </div>
    <script>
      const app = Vue.createApp({
          data() {
            return {
              name: 'Max Mustermann',
              email: 'max.mustermann@none.de',
              from: '2000-01-01',
              until: '2025-01-01',
              minlength: 0,
              maxlength: 5000,
              checked: true,
              newoption: 'Option Sechs',
              color: '#affee',
              design: 'design1.css',
              selected: 'Option3'
            }
          },
          methods: {
            getData: function () {
                fetch(`getFullMorbusJSONs.php?regex=`+this.regex+`&regex2=`+this.regex2+`&contra=`+this.contra+`&from=`+this.from+`&until=`+this.until+`&umgekehrt=`+this.umgekehrt+'&mintextlength='+this.mintextlength+'&maxtextlength='+this.maxtextlength)
                .then(res => res.json())
                .then(res => {
                    this.data = res;
                }); 
            },
            saveData: function () {
                fetch(`saveAsBookJSON.php?regex=`+this.regex+`&regex2=`+this.regex2+`&contra=`+this.contra+`&from=`+this.from+`&until=`+this.until+`&umgekehrt=`+this.umgekehrt+'&mintextlength='+this.mintextlength+'&maxtextlength='+this.maxtextlength+'&name='+this.name)
                .then(res => res.json())
                .then(res => {
                     if(res.antwort == 1) {
                        alert('gespeichert');
                     }
                }); 
            },
            loadData: function () {
                fetch(`loadBookJSON.php?bookJson=`+this.bookJson)
                .then(res => res.json())
                .then(res => {
                    if(res.antwort == 1) {
                        var inputs = res.json;
                        this.regex = inputs.regex;
                        this.regex2 = inputs.regex2;
                        this.contra = inputs.contra;
                        this.from = inputs.from;
                        this.until = inputs.until;
                        this.mintextlength = inputs.mintextlength;
                        this.maxtextlength = inputs.maxtextlength;
                        this.umgekehrt = inputs.umgekehrt;
                        this.name = this.bookJson.substr(0, this.bookJson.length-5);
                        fetch(`getFullMorbusJSONs.php?regex=`+inputs.regex+`&regex2=`+inputs.regex2+`&contra=`+inputs.contra+`&from=`+inputs.from+`&until=`+inputs.until+`&umgekehrt=`+inputs.umgekehrt+'&mintextlength='+inputs.mintextlength+'&maxtextlength='+inputs.maxtextlength)
                        .then(res => res.json())
                        .then(res => {
                            this.data = res;
                        }); 
                    } 
                }); 
            }
          }
        })
        app.mount('#app')
    </script>
</body>
</html>