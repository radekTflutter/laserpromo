 <script src= 
        "https://cdnjs.cloudflare.com/ajax/libs/vue/2.3.4/vue.min.js
 "> 
    </script> 
 
<div id="app" v-cloak>
  
  <h2>Kody</h2>
  <input type="file" ref="myFile" @change="selectedFile"> 
  <!-- <input type="submit" value="Upload File" /> -->
  <div v-if="allcode.length">
    <p>Liczba wierszy w pliku: {{allcode.length}} wierszy. Pierwszy wiersz pliku.</p>
    <ul>
	  <li v-for="code in codes">{{code}}</li>
    </ul>
  </div>
  
</div>
 

<script>
Vue.config.productionTip = false;
Vue.config.devtools = false;

const app = new Vue({
  el:'#app',
  data: {
    allcode:[]
  },
  computed:{
    codes() {
      return this.allcode.slice(0,1);
    }
  },
  methods:{
    selectedFile() {
      console.log('selected a file');
      console.log(this.$refs.myFile.files[0]);
      
      let file = this.$refs.myFile.files[0];
      if(!file || file.type !== 'text/plain') return;
       
      let reader = new FileReader();
      reader.readAsText(file, "UTF-8");
      
      reader.onload = evt => {
        let text = evt.target.result;
        this.allcode = text.split(/\r?\n/);
   
        if(this.allcode[this.allcode.length-1] === '') this.allcode.pop();
      }
      
      reader.onerror = evt => {
        console.error(evt);
      }
      
    }
  }
})
</script>