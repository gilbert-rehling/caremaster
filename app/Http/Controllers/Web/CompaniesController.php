<?php
/*
 * Laravel (R)   Kickstart Project
 * @version      CompaniesController.php -  001 - 15 6 2023
 * @link         https://github.com/gilbert-rehling/caremaster
 * @copyright    Copyright (c) 2023.  Gilbert Rehling. All right reserved. (https://github.com/gilbert-rehling)
 * @license      Released under the MIT model
 * @author       Gilbert Rehling:    gilbert@gilbert-rehling.com
 * This kickstart project provides basic authentication along with modeling for 2 data sets with a foreign key example
 * Created using Laravel 9.* on PHP 8.0.
 * To get started download and extract the package to your desired location.
 * Run: composer install.
 * Create an appropriate database. MySQL was used for this project.
 * Create and populate the .env file
 * Run: php artisan migrate
 * To seed the admin user run: php artisan db:seed --class=CreateUser
 * Seed data is also available for the Companies dataset.
 * Run: php artisan storage:link - to enable access to the public images
 */

namespace App\Http\Controllers\Web;

/**
 * @uses
 */
use App\Events\NewCompanyNotification;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Throwable;

/**
 * Handle web based company data requests
 *
 * Note: methods that change data have been wrapped in try/catch blocks
 *       This allows us to handle unexpected errors in a UX friendly manner
 *
 * ToDo: fix up the session flash alert class handling in the views
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
            // Report
            report($e);

            // Notify
            Session::flash('status', $e->getMessage());
            //Session::flash('alert-class', 'alert-danger');

            // Returning to the form is a safe option but may not fit your UX requirements
            redirect('/companies/create');
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
            // Report
            report($e);

            // Notify
            Session::flash('status', $e->getMessage());
            //Session::flash('alert-class', 'alert-danger');

            // Halt progress and return to form
            redirect('/companies/create');
        }
    }

    /**
     * Handles triggering the event
     *
     * @param Company $company
     * @return void
     */
    private function sendNotification(Company $company): void
    {
        event(new NewCompanyNotification($company));
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        /** @var Company $companies */
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
            $file = '';
            $data = $request->validated();

            // handle the logo upload
            if ($request->hasFile('logo')) {
                $file = $this->uploadLogo($request);
            }

            // save
            $company = new Company();
            $company->name      = $data['name'];
            $company->email     = $data['email'];
            $company->website   = $data['website'];
            $company->logo      = $file;
            $company->save();

            // send notification
            $this->sendNotification($company);

            // set message
            Session::flash('status', 'Company Created Successfully!');
            //Session::flash('alert-class', 'alert-success');

            // return to list
            return redirect('/companies');

        } catch (\Exception $e) {
            // Catch and report unhandled exceptions
            report($e);

            Session::flash('status', $e->getMessage());
            //Session::flash('alert-class', 'alert-danger');

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
        return view('admin/companies-item',
            [
                'company' => Company::find($id)
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
        return view('admin/companies-form',
            [
                'company' => Company::find($id)
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
                //Session::flash('alert-class', 'alert-success');

                // return to form
                return redirect('/companies/create/' . $id);
            }

            // set an error message
            Session::flash('status', 'Pre update security check failed!');
            //Session::flash('alert-class', 'alert-danger');

            // return to list
            return redirect('/companies');

        } catch (\Exception $e) {
            // Catch and report unhandled exceptions
            report($e);

            Session::flash('status', $e->getMessage());
            //Session::flash('alert-class', 'alert-danger');

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
                //Session::flash('alert-class', 'alert-success');

                // return to list
                return redirect('/companies');
            }

            // set message
            Session::flash('status', 'Zero (0) is not a valid entity ID');
            //Session::flash('alert-class', 'alert-danger');

            // return to list
            return redirect('/companies');

        } catch(\Exception $e) {
            // Catch and report unhandled exceptions
            report($e);

            Session::flash('status', $e->getMessage());
            //Session::flash('alert-class', 'alert-danger');

            // return to edit form
            return redirect('/companies/edit/' . $id);
        }
    }
}
