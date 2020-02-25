$(function() {
  let error = $('#error').val()
  console.log(error)
  if(error == 1) {
    $('.container-home').append(generateAlert('One or more params not given'))
  }
  if(error == 2) {
    $('.container-home').append(generateAlert('No items were selected'))
  }
  if(error == 3) {
    $('.container-home').append(generateAlert('No status was defined'))
  }

  if(error == 6) {
    $('.container-home').append(generateAlert('Name or title already exists'))
  }
})
