<head>
  <link rel="stylesheet" href="/public/css/exercise-editing.css">
</head>

<section class="container">
  <div class="row">
    <div class="column">
      <h1>Fields</h1>
      <table class="records">
        <thead>
          <tr>
            <th>Label</th>
            <th>Value kind</th>
            <th></th>
          </tr>
        </thead>

        <tbody>
        </tbody>
      </table>

      <a data-confirm="Are you sure? You won&#39;t be able to further edit this exercise" class="button" rel="nofollow" data-method="put" href="/exercises/411?exercise%5Bstatus%5D=answering"><i class="fa fa-comment"></i> Complete and be ready for answers</a>

    </div>
    <div class="column">
      <h1>New Field</h1>
      <form action="/exercises/411/fields" accept-charset="UTF-8" method="post"><input name="utf8" type="hidden" value="&#x2713;" /><input type="hidden" name="authenticity_token" value="G7bvuUztEHLMtcqm1ZR9Nyy6JRBbSSmj3s7CPWzhzOe7bbY2/KJhd8R8bPiBbADIUy12w7jwd7mBjiawrnu/jg==" />

        <div class="field">
          <label for="field_label">Label</label>
          <input type="text" name="field[label]" id="field_label" />
        </div>

        <div class="field">
          <label for="field_value_kind">Value kind</label>
          <select name="field[value_kind]" id="field_value_kind">
            <option selected="selected" value="single_line">Single line text</option>
            <option value="single_line_list">List of single lines</option>
            <option value="multi_line">Multi-line text</option>
          </select>
        </div>

        <div class="actions">
          <input type="submit" name="commit" value="Create Field" data-disable-with="Create Field" />
        </div>
      </form>
    </div>
  </div>
</section>