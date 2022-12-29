(function () {
  tinymce.PluginManager.add("opdracht_button", function (editor, url) {
    editor.addButton("opdracht_button", {
      text: "Opdracht",
      icon: false,
      onclick: function () {
        editor.insertContent("[opdracht]opdracht_hier[/opdracht]");
      },
    });
  });
})();
