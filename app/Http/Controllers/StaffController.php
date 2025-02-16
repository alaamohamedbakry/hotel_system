<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Role;
use App\Models\Staff;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:receptionist')->only(['booking. , booking.show']);
    }

    public function RegistrationForm()
    {
        $hotel = Hotel::all();
        return view('admin.staff.register', compact('hotel'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'First_name' => 'required|string|max:255',
            'Last_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'DateOfBirth' => 'required|date',
            'phone' => 'required|string|max:12',
            'email' => 'required|email|unique:staff,email',
            'password' => 'required|string|min:8|confirmed',
            'hire_date' => 'required|date',
            'hotel_id' => 'required|exists:hotel,id',
        ]);
        Staff::create([
            'First_name' => $request->First_name,
            'Last_name' => $request->Last_name,
            'position' => $request->position,
            'salary' => $request->salary,
            'DateOfBirth' => $request->DateOfBirth,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hire_date' => $request->hire_date,
            'hotel_id' => $request->hotel_id,

        ]);
        return redirect()->route('staff_login');
    }
    public function login()
    {
        return view('admin.staff.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('staff')->attempt($credentials)) {
            return redirect()->route('admin.dashboard')->with('success', 'Login successful');
        } else {
            return redirect()->route('staff_login')->with('error', 'Login unsuccessful');
        }
    }

    public function logout()
    {
        Auth::guard('staff')->logout();
        return redirect()->route('staff_login')->with('success', 'Logout successfully');
    }

    public function show_tables()
    {
        if (!Gate::allows('viewAny', Staff::class)) {
            abort(403, 'Unauthorized action.');
        }
        $staff = Staff::all();
        return view('admin.tables.staff', compact('staff'));
    }
    public function createstaff()
    {
        $hotel = Hotel::all();
        $roles = Role::all();
        return view('admin.forms.staff', compact('hotel','roles'));
    }
    public function storestaff(Request $request)
    {
        if (!Gate::allows('create', Staff::class)) {
            abort(403, 'Unauthorized action.');
        }
        $request->validate([
            'First_name' => 'required|string|max:255',
            'Last_name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'salary' => 'required|numeric|min:0',
            'DateOfBirth' => 'required|date',
            'phone' => 'required|string|max:12',
            'email' => 'required|email|unique:staff,email',
            'password' => 'required|string|min:8|confirmed',
            'hire_date' => 'required|date',
            'hotel_id' => 'required|exists:hotel,id',
            'roles' => 'required|array',
        ]);

        $staff = Staff::create([
            'First_name' => $request->First_name,
            'Last_name' => $request->Last_name,
            'position' => $request->position,
            'salary' => $request->salary,
            'DateOfBirth' => $request->DateOfBirth,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hire_date' => $request->hire_date,
            'hotel_id' => $request->hotel_id,
        ]);

        $staff->roles()->attach($request->roles);

        return redirect()->route('staff.show_tables')->with('msg', 'Staff created successfully!');
    }

    public function edit($id)
    {
        $hotel = Hotel::all();
        $staff = Staff::findOrFail($id);
        $roles = Role::all(); // جلب جميع الأدوار
        $staffRoles = $staff->roles->pluck('id')->toArray(); // جلب أدوار الموظف الحالي

        return view('admin.staff.edit', compact('staff', 'hotel', 'roles', 'staffRoles'));
    }

    public function update(Request $request, Staff $staff)
{
    if (!Gate::allows('update', $staff)) {
        abort(403, 'Unauthorized action.');
    }
    $request->validate([
        'First_name' => 'required|string|max:255',
        'Last_name' => 'required|string|max:255',
        'position' => 'required|string|max:255',
        'salary' => 'required|numeric|min:0',
        'DateOfBirth' => 'required|date',
        'phone' => 'required|string|max:12',
        'email' => 'required|email|unique:staff,email,' . $staff->id, // السماح بنفس الإيميل للموظف الحالي
        'password' => 'nullable|string|min:8|confirmed',
        'hire_date' => 'required|date',
        'hotel_id' => 'required|exists:hotel,id',
        'roles' => 'required|array', // التأكد من أن الأدوار موجودة
    ]);

    $password = $request->password ? Hash::make($request->password) : $staff->password;

    try {
        $staff->update([
            'First_name' => $request->First_name,
            'Last_name' => $request->Last_name,
            'position' => $request->position,
            'salary' => $request->salary,
            'DateOfBirth' => $request->DateOfBirth,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $password,
            'hire_date' => $request->hire_date,
            'hotel_id' => $request->hotel_id,
        ]);

        // تحديث الأدوار
        $staff->roles()->sync($request->roles);

        return redirect()->route('staff.show_tables')->with('msg', 'Staff updated successfully');
    } catch (Exception $e) {
        return redirect()->route('staff.show_tables')->with('error', $e->getMessage());
    }
}

public function destroy(Staff $staff)
{
    if (!Gate::allows('delete', $staff)) {
        abort(403, 'Unauthorized action.');
    }
    try {
        // إزالة جميع الأدوار المرتبطة
        $staff->roles()->detach();

        // حذف الموظف
        $staff->delete();

        return redirect()->route('staff.show_tables')->with('msg', 'Staff deleted successfully');
    } catch (Exception $e) {
        return redirect()->route('staff.show_tables')->with('error', $e->getMessage());
    }
}

}
