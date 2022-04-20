//console.log('Hello World')
const d = document,
  $addForm = d.getElementById('add-form'),
  $editForm = d.getElementById('edit-form'),
  $inputEditForm = d.querySelectorAll('#edit-form input'),
  $list = d.getElementById('customer-list'),
  $alert = d.querySelectorAll('.alert'),
  $addModal = d.getElementById('addModal'),
  $editModal = d.getElementById('editModal'),
  addModal = new bootstrap.Modal($addModal),
  editModal = new bootstrap.Modal($editModal)

function validateEmail (email) {
  const emailPatter = /^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$/
  return emailPatter.test(email)
}

$addForm.addEventListener('submit', e => {
  e.preventDefault()

  const names = e.target.names.value,
    lastName = e.target.lastName.value,
    lastName2 = e.target.lastName2.value,
    address = e.target.address.value,
    email = e.target.email.value

  if (
    names === '' ||
    lastName === '' ||
    lastName2 === '' ||
    address === '' ||
    email === ''
  ) {
    $alert[0].textContent = 'Existen campos vacios'
    $alert[0].classList.remove('d-none')
    return
  }

  if (!validateEmail(email)) {
    $alert[0].textContent = 'El email no es valido'
    $alert[0].classList.remove('d-none')
    return
  }

  fetch('http://localhost:8080/exam/customer/createCustomer', {
    method: 'POST',
    body: new FormData(e.target)
  })
    .then(res => (res.ok ? res.json() : Promise.reject(res)))
    .then(json => {
      // console.log(json)
      if (json.status === 'success') {
        const $tr = d.createElement('tr'),
          $tdId = d.createElement('td'),
          $tdNames = d.createElement('td'),
          $tdLastName = d.createElement('td'),
          $tdLastName2 = d.createElement('td'),
          $tdAddress = d.createElement('td'),
          $tdEmail = d.createElement('td'),
          $tdActions = d.createElement('td')

        $tr.dataset.id = json.data.id
        $tdId.textContent = json.data.id
        $tdNames.textContent = names
        $tdLastName.textContent = lastName
        $tdLastName2.textContent = lastName2
        $tdAddress.textContent = address
        $tdEmail.textContent = email
        $tdActions.innerHTML =
          '<button type="button" class="btn btn-link btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button><button type="button" class="btn btn-link text-danger btn-delete" >Eliminar</button>'

        $tr.appendChild($tdId)
        $tr.appendChild($tdNames)
        $tr.appendChild($tdLastName)
        $tr.appendChild($tdLastName2)
        $tr.appendChild($tdAddress)
        $tr.appendChild($tdEmail)
        $tr.appendChild($tdActions)

        $list.appendChild($tr)
        addModal.hide()

        // Show Message
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Cliente creado correctamente!',
          showConfirmButton: false,
          timer: 1500
        })
      } else {
        $alert[0].textContent = json.message
        $alert[0].classList.remove('d-none')
      }
    })
    .catch(e => {
      console.log(e)
    })
    .finally(() => {
      $addForm.reset()
    })
})

$editForm.addEventListener('submit', e => {
  e.preventDefault()

  const id = e.target.id.value,
    names = e.target.names.value,
    lastName = e.target.lastName.value,
    lastName2 = e.target.lastName2.value,
    address = e.target.address.value,
    email = e.target.email.value

  if (
    id === '' ||
    names === '' ||
    lastName === '' ||
    lastName2 === '' ||
    address === '' ||
    email === ''
  ) {
    $alert[1].textContent = 'Los campos no pueden estar vacios'
    $alert[1].classList.remove('d-none')
    return
  }

  if (!validateEmail(email)) {
    $alert[1].textContent = 'El email no es valido'
    $alert[1].classList.remove('d-none')
    return
  }

  fetch('http://localhost:8080/exam/customer/updateCustomer', {
    method: 'POST',
    body: new FormData(e.target)
  })
    .then(res => (res.ok ? res.json() : Promise.reject(res)))
    .then(json => {
      // console.log(json)
      if (json.status === 'success') {
        $columns = d.querySelectorAll(`[data-id='${id}'] td`)

        $columns[1].textContent = names
        $columns[2].textContent = lastName
        $columns[3].textContent = lastName2
        $columns[4].textContent = address
        $columns[5].textContent = email
        // console.log($tr)

        editModal.hide()

        // show Message
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Cliente Actualizado correctamente.',
          showConfirmButton: false,
          timer: 1500
        })
      } else {
        $alert[1].textContent = json.message
        $alert[1].classList.remove('d-none')
      }
    })
    .catch(e => {
      console.log(e)
    })
    .finally(() => {
      $editForm.reset()
    })
})

d.addEventListener('click', e => {
  if (e.target.matches('.btn-edit')) {
    // console.log('click edit')
    $alert[1].classList.add('d-none')

    const $tr = e.target.parentElement.parentElement,
      id = $tr.dataset.id

    const data = new FormData()
    data.append('id', id)

    fetch('http://localhost:8080/exam/customer/getCustomerById', {
      method: 'POST',
      body: data
    })
      .then(res => (res.ok ? res.json() : Promise.reject(res)))
      .then(json => {
        // console.log(json)
        // console.log($inputEditForm)
        $inputEditForm[0].value = json.data.id
        $inputEditForm[1].value = json.data.names
        $inputEditForm[2].value = json.data.lastName
        $inputEditForm[3].value = json.data.lastName2
        $inputEditForm[4].value = json.data.address
        $inputEditForm[5].value = json.data.email
      })
  }

  if (e.target.matches('.btn-delete')) {
    // console.log('click delete')
    const $tr = e.target.parentElement.parentElement,
      id = $tr.dataset.id

    if (id == '') return

    const data = new FormData()
    data.append('id', id)

    if (!confirm('Estas seguro de eliminar el cliente?')) return

    fetch('http://localhost:8080/exam/customer/deleteCustomer', {
      method: 'POST',
      body: data
    })
      .then(res => (res.ok ? res.json() : Promise.reject(res)))
      .then(json => {
        // console.log(json)
        if (json.status === 'success') {
          $tr.remove()

          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Cliente eliminado correctamente.',
            showConfirmButton: false,
            timer: 1500
          })
        } else {
          Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Cliente eliminado correctamente.',
            showConfirmButton: false,
            timer: 1500
          })
        }
      })
  }

  if (e.target.matches('.btn-add')) {
    // console.log('click add')
    $alert[0].classList.add('d-none')
    $addForm.reset()
  }
})
