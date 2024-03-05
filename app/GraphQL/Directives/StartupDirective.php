<?php

namespace App\GraphQL\Directives;

use App\Exceptions\customException;
use Nuwave\Lighthouse\Schema\Directives\BaseDirective;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Auth\AuthenticationException as AuthAuthenticationException;
use Nuwave\Lighthouse\Schema\Values\FieldValue;
use Nuwave\Lighthouse\Support\Contracts\DefinedDirective;
use Nuwave\Lighthouse\Support\Contracts\FieldMiddleware;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Illuminate\Support\Facades\Auth;

class StartupDirective extends BaseDirective implements FieldMiddleware, DefinedDirective
{
    public static function definition(): string
    {
        return /** @lang GraphQL */ <<<'GRAPHQL'
directive @startup on FIELD_DEFINITION
GRAPHQL;
    }
    // TODO implement the directive https://lighthouse-php.com/master/custom-directives/getting-started.html
    public function handleField(FieldValue $fieldValue, Closure $next)
    {
        // Retrieve the existing resolver function
        /** @var Closure $previousResolver */
        $resolver = $fieldValue->getResolver();

        // Wrap around the resolver
        $fieldValue->setResolver(function ($root, array $args, GraphQLContext $context, ResolveInfo $resolveInfo) use ($resolver) {
            // Do something before the resolver, e.g. validate $args, check authentication

            $result = $resolver($root, $args, $context, $resolveInfo);

            $user =  Auth::user();
        if($user){
            if($user->role != 'start_up'){
                // return response()->json(['error' => 'user not of start up role'], 403);
                throw new AuthAuthenticationException(
                    'Role type error: The users role is not startup',
                    // 'This user does not belong to Startup role type'
                );
            }
        }
            return $result;

        });

        // Keep the chain of adding field middleware going by calling the next handler.
        // Calling this before or after ->setResolver() allows you to control the
        // order in which middleware is wrapped around the field.

        // $
        return $next($fieldValue);
    }
}
