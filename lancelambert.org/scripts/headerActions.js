(function($, Edge, compId){
var Composition = Edge.Composition, Symbol = Edge.Symbol; // aliases for commonly used Edge classes

   //Edge symbol: 'stage'
   (function(symbolName) {
      
      
      Symbol.bindElementAction(compId, symbolName, "${_Text2}", "click", function(sym, e) {
         window.open("http://lancelambert.org/middle-east-update.php", "_blank");
         

      });
      //Edge binding end

      Symbol.bindTriggerAction(compId, symbolName, "Default Timeline", 11433, function(sym, e) {
         sym.play('start');

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Text2Copy}", "click", function(sym, e) {
         window.open("http://www.lancelambert.org/vision.html", "_blank");
         

      });
      //Edge binding end

      Symbol.bindElementAction(compId, symbolName, "${_Text2Copy3}", "click", function(sym, e) {
         window.open("http://www.lancelambert.org/audio.php", "_blank");
         

      });
      //Edge binding end

   })("stage");
   //Edge symbol end:'stage'

})(jQuery, AdobeEdge, "header_animation");