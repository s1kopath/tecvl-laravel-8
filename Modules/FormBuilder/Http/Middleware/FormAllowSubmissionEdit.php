<?php


namespace Modules\FormBuilder\Http\Middleware;

use Closure;

use Modules\FormBuilder\Entities\Submission;

class FormAllowSubmissionEdit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $submission_id = $request->route('my_submission');

        $user = $request->user();
        $submission = Submission::where(['id' => $submission_id])->firstOrFail();

        if (!$submission->form->allowsEdit()) {
            // this form does not allow edit
            return redirect()
                ->route('formbuilder::my-submissions.show', $submission->id)
                ->with('error', __("Form ':x' does not allow submission edit.", ['x' => $submission->form->name]));
        }

        return $next($request);
    }
}
