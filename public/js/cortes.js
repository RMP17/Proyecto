var appCortes = new Vue({
  el: '#app-cortes',
  data: {
      el:{
        canvas:null
      },
      config:{
        sort:'width',
        scale: 1
      },
      size:{
        width:'',
        height:'',
      },
      cortes: [
        {
          width:'',
          height:'',
          cant:''
        }
      ]
  },
  mounted() {
    // Mounted
    this.el.canvas = document.getElementById('canvas');
  },
  methods: {
    // Methods
    addCut: function(){
      this.cortes.push({
        width: '',
        height: '',
        cant: ''
      });
    },
    removeCut: function(index){
      console.log(index)
      console.log(this.cortes.splice(index,1));
    },
    changeWidth: function(e,index){
      //console.log(e.target.value, index)
      this.cortes[index].width = e.target.value;
    },
    changeHeight: function(e,index){
      this.cortes[index].height = e.target.value;
    },
    changeCant: function(e,index){
      this.cortes[index].cant = e.target.value;
    },

    runCut(e){
      e.preventDefault();
      var blocks = this.deserialize(this.dataEncode());
      var packer = this.packer();
      this.now(blocks);
      packer.fit(blocks);
      console.log(blocks);
      this.el.draw = this.el.canvas.getContext("2d");
      this.el.draw.imageSmoothingQuality = "high";
      this.reset(packer.root.w,packer.root.h);
      
      this.blocks(blocks);
      this.stroke(packer.root.x,packer.root.y,packer.root.w,packer.root.h);

      //this.report(blocks, packer.root.w, packer.root.h);
      this.printCanvas(this.report(blocks, packer.root.w, packer.root.h));
    },
    dataEncode: function(){
      let data = "";
      this.cortes.forEach(corte => {
        data+=(corte.width*this.config.scale)+"x"+(corte.height*this.config.scale)+"x"+corte.cant+"\n";
      });
      return data;
    },
    // methods of cut
    report: function(blocks, w, h) {
      var fit = 0, nofit = [], block, n, len = blocks.length;
      for (n = 0 ; n < len ; n++) {
        block = blocks[n];
        if (block.fit)
          fit = fit + block.area;
        else
          nofit.push("" + block.w/this.config.scale + "x" + block.h/this.config.scale);
      }
      //$('#info').show();
      return {
        ratio: Math.round(100 * fit / (w * h)),
        notif: nofit.length > 0 ? "Detalles: No se pudo hacer los siguientes cortes (" + nofit.length + ") :<br>" + nofit.join(", "):""
      }
      //$('#ratio').text(Math.round(100 * fit / (w * h)));
      //$('#notif').html("No se pudo hacer los siguientes cortes (" + nofit.length + ") :<br>" + nofit.join(", ")).toggle(nofit.length > 0);
    },
    deserialize: function(val) {
      var i, j, block, blocks = val.split("\n"), result = [];
      for(i = 0 ; i < blocks.length ; i++) {
        block = blocks[i].split("x");
        if (block.length >= 2)
          result.push({w: parseFloat(block[0]), h: parseFloat(block[1]), num: (block.length == 2 ? 1 : parseInt(block[2])) });
      }
      var expanded = [];
      for(i = 0 ; i < result.length ; i++) {
        for(j = 0 ; j < result[i].num ; j++)
          expanded.push({w: result[i].w, h: result[i].h, area: result[i].w * result[i].h});
      }
      return expanded;
    },
    serialize: function(blocks) {
      var i, block, str = "";
      for(i = 0; i < blocks.length ; i++) {
        block = blocks[i];
        str = str + block.w + "x" + block.h + (block.num > 1 ? "x" + block.num : "") + "\n";
      }
      return str;
    },
    packer: function() {
      return new Packer(parseFloat(this.size.width*this.config.scale), parseFloat(this.size.height*this.config.scale));
    },


    // sort
    random  : function (a,b) { return Math.random() - 0.5; },
    w       : function (a,b) { return b.w - a.w; },
    h       : function (a,b) { return b.h - a.h; },
    a       : function (a,b) { return b.area - a.area; },
    max     : function (a,b) { return Math.max(b.w, b.h) - Math.max(a.w, a.h); },
    min     : function (a,b) { return Math.min(b.w, b.h) - Math.min(a.w, a.h); },

    height  : function (a,b) { return this.msort(a, b, ['h', 'w']);               },
    width   : function (a,b) { return this.msort(a, b, ['w', 'h']);               },
    area    : function (a,b) { return this.msort(a, b, ['a', 'h', 'w']);          },
    maxside : function (a,b) { return this.msort(a, b, ['max', 'min', 'h', 'w']); },

    msort: function(a, b, criteria) { /* sort by multiple criteria */
      var diff, n;
      for (n = 0 ; n < criteria.length ; n++) {
        diff = this[criteria[n]](a,b);
        if (diff != 0)
          return diff;  
      }
      return 0;
    },

    now: function(blocks) {
      blocks.sort(this.maxside);
    },


    // canvas
    reset: function(width, height) {
      this.el.canvas.width  = width  + 1; // add 1 because we draw boundaries offset by 0.5 in order to pixel align and get crisp boundaries
      this.el.canvas.height = height + 1; // (ditto)
      this.el.draw.clearRect(0, 0, this.el.canvas.width, this.el.canvas.height);
    },

    rect:  function(x, y, w, h, color) {
      this.el.draw.fillStyle = color;
      this.el.draw.fillRect(x + 0.5, y + 0.5, w, h);
      this.stroke(x,y,w,h);
      this.el.draw.font='14px Arial';
      this.el.draw.fillStyle = "#000000";
      this.el.draw.fillText(""+(w/this.config.scale)+"x"+(h/this.config.scale), x+ 1, y+ 14);
    },

    stroke: function(x, y, w, h) {
      this.el.draw.strokeRect(x + 0.5, y + 0.5, w, h);
    },

    blocks: function(blocks) {
      var n, block;
      for (n = 0 ; n < blocks.length ; n++) {
        block = blocks[n];
        if (block.fit){
          this.rect(block.fit.x, block.fit.y, block.w, block.h, "#f1f1f2");
        }
      }
    },
    
    boundary: function(node) {
      if (node) {
        this.stroke(node.x, node.y, node.w, node.h);
        this.boundary(node.down);
        this.boundary(node.right);
      }
    },
    // print result
    printCanvas: function(result){
      var dataUrl = document.getElementById('canvas').toDataURL(); //attempt to save base64 string to server using this var  
      var windowContent = '<!DOCTYPE html>';
      windowContent += '<html>'
      windowContent += '<head><title>Corte Nuevo</title></head>';
      windowContent += '<body>';
      windowContent += '<h1>Tamaño Placa: '+this.size.width+'x'+this.size.height+' <strong>[cm]</strong><h1>';
      windowContent += '<h3>Porcentaje utilizado de la plaza: '+result.ratio+'%<h3>';
      windowContent += '<h3>'+result.notif+'<h3>';
      windowContent += '<button onclick="print()"> Imprimir Resultados </button><br><br>';
      windowContent += '<img src="' + dataUrl + '">';
      windowContent += '</body>';
      windowContent += '</html>';
      var printWin = window.open('','','width=700,height=600');
      printWin.document.write(windowContent);
      /*
      setTimeout(function(){
        printWin.focus();
        printWin.print();
        printWin.close();
      },1000);
      */
    }
  }

});