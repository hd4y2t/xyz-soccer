<?php

namespace App\Services;

use App\Models\Team;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TeamService
{
    public function getAll()
    {
        return Team::query()
            ->with('players')
            ->get();
    }

    public function findById($id)
    {
        return Team::query()
            ->with('players')
            ->findOrFail($id);
    }

    public function create(array $data, ?UploadedFile $logo)
    {
        if ($logo) {
            $filename = uniqid('team_') . '.' . $logo->getClientOriginalExtension();
            $logo->store('teams', 'public');

            // $logo->storeAs('public/teams', $filename);
            $data['logo'] = $filename;
        }

        return Team::create($data);
    }

    public function update(Team $team, array $data, ?UploadedFile $logo)
    {
        if ($logo) {
            if ($team->logo && Storage::disk('public')->exists('teams/' . $team->logo)) {
                Storage::disk('public')->delete('teams/' . $team->logo);
            }

            $filename = uniqid('team_') . '.' . $data['logo']->getClientOriginalExtension();
            $data['logo']->storeAs('teams', $filename, 'public');
            $data['logo'] = $filename;
        } else {
            unset($data['logo']);
        }

        $team->update([
            'name'          => $data['name'] ?? $team->name,
            'logo'          => $data['logo'] ?? $team->logo,
            'founded_year'  => $data['founded_year'] ?? $team->founded_year,
            'home_address'  => $data['home_address'] ?? $team->home_address,
            'city'          => $data['city'] ?? $team->city,
            'country'       => $data['country'] ?? $team->country,
        ]);

        return $team;
    }

    public function delete(Team $team): bool
    {
        if ($team) {
            if ($team->logo && Storage::disk('public')->exists('teams/' . $team->logo)) {
                Storage::disk('public')->delete('teams/' . $team->logo);
            }

            $team->delete();
            return true;
        }

        return false;
    }
}
