package MyCGI;

use strict;
use warnings;
#use diagnostics;
use Exporter 'import';
our @EXPORT_OK = qw(param);

use CGI;

use base 'CGI';

sub new {
    my $class = shift;
    my $self = $class->SUPER::new(@_);
    return $self;
}

# Mostly for debugging
sub param_raw {
    my $self = shift;
    scalar($self->SUPER::param(@_));
}

sub param {
    my $self = shift;
    my $param_name = shift;
    return $self->SUPER::param($param_name)  if ( !$param_name );

    # NOTE: param() may be called by the CGI module code, so we must make sure
    # that this override does not interfere with the base method: we only check
    # the input if we determine that the param must be checked.
    if (must_check($param_name)) {
        if (wantarray()) {
            my @param_values = $self->SUPER::param($param_name);
            # Will die on unauthorized chars!
            map { check_characters($_) } @param_values;
            return @param_values;
        } else {
#            warn "param name: $param_name\n";
            my $param_value = $self->SUPER::param($param_name);
#            warn "param value: '$param_value'\n";
            check_characters($param_value);
            return $param_value;
        }
    } else { # Param unknown (probably internal) - don't sanitize.
        if (wantarray()) {
            return ($self->SUPER::param($param_name));
        } else {
            return $self->SUPER::param($param_name);
        }
    }
}

# I'm sure this can be shortened to just a single regexp, but let's keep it a
# little more explicit for now, shall we?
sub must_check {
    my $param_name = shift;
    # Special params from the CGI module start with a '.', or so I gather - don't
    # check them them. Otherwise, assume it's a regular param, and perform check.
    if ($param_name =~ /^\./) {
        return 0;
    } else {
        return 1;
    }
}

# Die on anything that is NOT an alphanumeric character.
sub check_characters {
    my ($value) = @_;
    if ( $value =~ /[^\w \+\-\/\.,:>\n\r\(\)]/ ){
        my $match = $&;
        my $hex_match = sprintf '%04x', ord $match;
        die "FATAL - Unauthorized character '$match' / '$hex_match' in parameter '$value'";
    }
}

1;

