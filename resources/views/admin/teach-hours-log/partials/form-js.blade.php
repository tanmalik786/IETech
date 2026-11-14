<script>
  const modal = document.querySelector('#addHoursLogModal');
  let hours = 0;

  const hours_of_contact_time_el = document.querySelector('input[name=hours_of_contact_time]');
  const week_beginning_el = document.querySelector('input[name=week_beginning]');
  const description_el = document.querySelector('textarea[name=description]');
  const log_id_el = document.querySelector('input[name=id]');

  let logs = [];

  @if(isset($post))

    fetchPostLogs = async () => {

    const fetchResult = await fetch('{{route('ajaxFetchHoursLog', ['post' => $post->id])}}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        '_token': '{{csrf_token()}}',
      }),
    });

    return await fetchResult.json();
  };

  fetchPostLogs().then((res) => {
    logs = res;
    updateLogList();
  });
  @endif

  const resetForm = () => {
    hours_of_contact_time_el.value = '';
    week_beginning_el.value = '';
    description_el.value = '';
    log_id_el.value = '';
    formDataSaved = false;
  };

  const editLog = (logIndex) => {
    const log = logs[logIndex];

    hours_of_contact_time_el.value = log.hours_of_contact_time;
    week_beginning_el.value = log.week_beginning;
    description_el.value = log.description;
    log_id_el.value = logIndex;

    $(modal).modal('show');
  };

  const removeLog = (logIndex) => {
    if (logs[logIndex]) {
      logs.splice(logIndex, 1);
    }

    formDataSaved = false;
    updateLogList();
  };

  const updateLogList = () => {
    const tableBody = document.querySelector('tbody');

    let rows = ``;
    if (logs.length >= 1) {
      logs.forEach((log, index) => {

        const dayName = new Date(log.week_beginning.split('/')[2], log.week_beginning.split('/')[1] - 1, log.week_beginning.split('/')[0]).toLocaleDateString('en-GB', {weekday:'long'});

        rows += `
                        <input type="hidden" class="week_dates" name="logs[${index}][week_beginning]" value="${log.week_beginning}">
                        <input type="hidden" name="logs[${index}][description]" value="${log.description}">
                        <input type="hidden" name="logs[${index}][hours_of_contact_time]" value="${log.hours_of_contact_time}">
                        <tr id="${index}" data-day="${dayName}">
                            <td>${index + 1}</td>
                            <td class="date">${log.week_beginning}</td>
                            <td>${log.description}</td>
                            <td>${log.hours_of_contact_time}</td>
                            <td>
                                <a href="javascript:void(0)" onclick="editLog(${index})"><i class="fas fa-pencil-alt text-dark mr-1"></i></a>
                                <a href="javascript:void(0)" onclick="removeLog(${index})"><i class="fas fa-trash-alt text-danger"></i></a>
                            </td>
                        </tr>
                    `;
      });
    }
    else {
      rows += `<tr><td colspan="5">No hours Logged</td></tr>`;
    }

    tableBody.innerHTML = '';
    tableBody.innerHTML = rows;
    updateHours()
  };

  const addLog = (eve) => {

    eve.preventDefault();

    // Do not like this, but my hands are tide cuz
    // btsrap4 uses jquery
    $(modal).modal('hide');

    // check if id is present in log index
    const logIndex = log_id_el.value;
    if (logIndex != '' || logIndex != undefined && logs[logIndex]) {
      logs[logIndex].week_beginning = week_beginning_el.value;
      logs[logIndex].description = description_el.value;
      logs[logIndex].hours_of_contact_time = hours_of_contact_time_el.value;
    }
    else {
      logs.push({
        hours_of_contact_time: hours_of_contact_time_el.value,
        week_beginning: week_beginning_el.value,
        description: description_el.value,
      });
    }

    updateLogList();
    resetForm();
  };

  const updateHours = () => {
    hours = 0;

    if( logs.length > 0 ) {
      for( let log of logs) {
        hours += parseFloat(log.hours_of_contact_time)
      }
    }

    $('.totalHours').val(hours);
  }

  const logForm = document.querySelector('#updateHourLogForm');
  logForm.addEventListener('submit', addLog);

  $(modal).on('shown.bs.modal', function () {
    const lastDate = $("tbody").find('tr:last-child').find('.date').text()
    if( lastDate ) {
      if( $(modal).find('input[name=week_beginning]').val() === '' ) {
        $(modal).find('input[name=week_beginning]').val(lastDate)
      }

    }
  })
</script>