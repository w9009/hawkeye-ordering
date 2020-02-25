function generateAlert(text)  {
  setInterval(function(){ $('.alert').remove() }, 4000);
  return "<div class='alert alert-top alert-primary active' role='alert'>" + text + "</div>"
}
