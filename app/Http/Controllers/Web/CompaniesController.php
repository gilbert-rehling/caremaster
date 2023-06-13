<?php

namespace App\Http\Controllers\Web;

/**
 * @uses
 */
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use mysql_xdevapi\Exception;
use Throwable;

/**
 * Handle web based company data requests
 */
class CompaniesController extends Controller
{
    /**
     * Handle the logo upload
     *
     * @param CreateCompanyRequest $request
     * @return string|null
     */
    private function uploadLogo(CreateCompanyRequest $request): ?string
    {
        try {
            // The storage path begins at /storage/app/ - so we need the full public path
            $path = $request->file('logo')->store('public/images/');

            // we only want to return the unique filename
            $arr = explode('/', $path);
            return array_pop($arr);

        } catch (\Exception $e) {
            Session::flash('status', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');

            // return to form
            return redirect('/companies/create');
        }
    }

    /**
     * Handle the logo deletion
     *
     * @param string $logo
     * @param int $id
     * @return void
     */
    private function deleteLogo(string $logo, int $id): void
    {
        try {
            $path = 'public/images/' . $logo;
            Storage::delete($path);

        } catch (\Exception $e) {
            // do not continue !!
            Session::flash('status', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');

            // return to form
            redirect('/companies/create');
            return;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        /** @var Company $companies */
        // $companies = Company::all();
        return view(
            'admin/companies',
            [
                'companies' => DB::table('companies')->paginate(10)
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin/companies-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateCompanyRequest $request
     * @return Redirector|RedirectResponse
     * @throws Throwable
     */
    public function store(CreateCompanyRequest $request): Redirector|RedirectResponse
    {
        try {
            $file = false;
            $data = $request->validated();

            // handle the logo upload
            if ($request->hasFile('logo')) {
                $file = $this->uploadLogo($request);
            }

            // save
            Company::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'website' => $data['website'],
                'logo'  => $file
            ]);

            // set message
            Session::flash('status', 'Company Created Successfully!');
            Session::flash('alert-class', 'alert-success');

            // return to list
            return redirect('/companies');

        } catch (ValidationException $e) {
            // This should be handled by Laravel
            Session::flash('status', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');

            // return to form
            return redirect('/companies/create');

        } catch (\Exception $e) {
            // get unhandled exceptions
            Session::flash('status', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');

            // return to form
            return redirect('/companies/create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function show(int $id): View
    {
        $company = Company::find($id);
        return view('admin/companies-item',
            [
                'company' => $company
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit(int $id): View
    {
        $company = Company::find($id);
        return view('admin/companies-form',
            [
                'company' => $company
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * ToDo: for brevity I have omitted and logo update here !!
     *
     * @param UpdateCompanyRequest $request
     * @param int $id
     * @return Redirector|RedirectResponse
     */
    public function update(UpdateCompanyRequest $request, int $id): Redirector|RedirectResponse
    {
        try {
            $data = $request->validated();
            // idiot check
            if ($data['id'] == $id) {
                // do update
                $company = Company::find($id);
                $company->name = $data['name'];
                $company->email = $data['email'];
                $company->website = $data['website'];
                $company->save();

                // success
                Session::flash('status', 'Company entity with ID ' . $id . ' updated successfully!');
                Session::flash('alert-class', 'alert-success');

                // return to form
                return redirect('/companies/create/' . $id);
            }

            // set an error message
            Session::flash('status', 'Pre update security check failed!');
            Session::flash('alert-class', 'alert-danger');

            // return to list
            return redirect('/companies');

        } catch (\Exception $e) {
            // get unhandled exceptions
            Session::flash('status', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');

            // return to form
            return redirect('/companies/create/' . $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Redirector|RedirectResponse
     */
    public function destroy(int $id): Redirector|RedirectResponse
    {
        try {
            if ($id > 0) {
                $company = Company::find($id);
                if ($company->logo) {
                    // delete the logo - redirects on error
                    $this->deleteLogo($company->logo, $id);
                }

                Company::where('id', $id)->delete();

                // set message
                Session::flash('status', 'Company entity with ID ' . $id. ' deleted successfully!');
                Session::flash('alert-class', 'alert-success');

                // return to list
                return redirect('/companies');
            }

            // set message
            Session::flash('status', 'Zero (0) is not a valid entity ID');
            Session::flash('alert-class', 'alert-danger');

            // return to list
            return redirect('/companies');

        } catch(\Exception $e) {
            // get unhandled exceptions
            Session::flash('status', $e->getMessage());
            Session::flash('alert-class', 'alert-danger');

            // return to form
            return redirect('/companies/create/' . $id);
        }
    }
}
