@extends("layouts.navbar")

@section('content')
    <script>
        $(function () {
            const admins = <?php echo $admins ?>;

            function split(val) {
                return val.split(/,\s*/);
            }

            function extractLast(term) {
                return split(term).pop();
            }

            $('#admin').on("keydown", function (event) {
                if (event.keyCode === $.ui.keyCode.TAB &&
                    $(this).autocomplete("instance").menu.active) {
                    event.preventDefault();
                }
            }).autocomplete({
                minLength: 0,
                source: function (request, response) {
                    response($.ui.autocomplete.filter(
                        admins, extractLast(request.term)));
                },
                focus: function () {
                    return false;
                },
                select: function (event, ui) {
                    var terms = split(this.value);
                    terms.pop();
                    terms.push(ui.item.value);
                    terms.push("");
                    this.value = terms.join(", ");
                    return false;
                }
            });
        });
    </script>
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <h3 class="card-header text-center">Ajouter des administrateurs</h3>
                        <div class="card-body">
                            <form action="{{route('add.admin.process')}}" method="post">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="admin">Nom ou prenom</label>
                                    <textarea type="text" class="form-control autocomplete" id="admin" name="admin"
                                              required autofocus></textarea>
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Ajouter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

@endsection
