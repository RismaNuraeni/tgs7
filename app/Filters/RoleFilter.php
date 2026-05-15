<?php
namespace App\Filters;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to(base_url('login'))
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!empty($arguments)) {
            $currentRole = session()->get('role');
            if (!in_array($currentRole, $arguments)) {
                return redirect()->to(base_url('dashboard'))
                    ->with('error', 'Akses ditolak. Halaman ini khusus: ' . implode(', ', $arguments));
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null) {}
}